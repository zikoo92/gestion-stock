<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $sort = $request->input('sort', 'name');
        $direction = $request->input('dir', 'asc');
        $perPage = $request->input('per_page', 10);

        $allowedSorts = ['name', 'sku', 'prix_vente', 'quantite', 'created_at'];
        if (!in_array($sort, $allowedSorts)) 
            $sort = 'name';

        $products = Product::when($q, function($query, $q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('sku', 'like', "%{$q}%");
            })
            ->orderBy($sort, $direction)
            ->paginate($perPage)
            ->withQueryString();
            return view('products.index', compact('products', 'q', 'sort', 'direction', 'perPage'));
    /*

        $products = Product::all();
        return view('products.index', compact('products'));
    */
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku',
            'prix_achat' => 'nullable|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('produits.index')->with('success', 'Produit ajouté.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)    
    {
       $product = Product::findOrFail($id);
       return view( 'products.edit', compact('product') );  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $product = Product::findOrFail($id);

    $validated = $request->validate([
        'name'       => 'required|string|max:255',
        'sku'        => 'required|string|max:255|unique:products,sku,' . $product->id,
        'prix_achat' => 'nullable|numeric',
        'prix_vente' => 'required|numeric',
        'quantite'   => 'required|integer',
        'image'      => 'nullable|image|max:2048',
    ]);

    // upload image si nouveau fichier
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('produits', 'public');
    }

    $product->update($validated);

    return redirect()->route('produits.index')
                     ->with('success', 'Produit modifié avec succès !');
    }


    public function updateQuantity(Request $request, Product $produit)
    {
        $request->validate([
            'quantite' => 'required|integer',
        ]);

        $produit->quantite = $request->input('quantite');
        $produit->save();

        return redirect()->route('produits.index')
                        ->with('success', 'Quantité mise à jour !');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $produit)
    {
            if ($produit->image) {
        \Storage::disk('public')->delete($produit->image);
    }

    $produit->delete();

    return redirect()->route('produits.index')
                     ->with('success', 'Produit supprimé avec succès !');
    }
}