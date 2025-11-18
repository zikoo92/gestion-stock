@extends('layout.template')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-4">Liste des produits</h1>

    <!-- Barre de recherche et filtres -->
    <form method="GET" action="{{ route('produits.index') }}" class="flex flex-wrap gap-2 mb-4 items-center">
        <input type="text" name="q" placeholder="Rechercher par nom ou SKU"
               value="{{ $q }}"
               class="border border-gray-300 rounded px-2 py-1 flex-1 min-w-[200px]">

        <select name="sort" class="border border-gray-300 rounded px-2 py-1">
            <option value="name" {{ $sort == 'name' ? 'selected' : '' }}>Nom</option>
            <option value="sku" {{ $sort == 'sku' ? 'selected' : '' }}>SKU</option>
            <option value="prix_vente" {{ $sort == 'prix_vente' ? 'selected' : '' }}>Prix vente</option>
            <option value="quantite" {{ $sort == 'quantite' ? 'selected' : '' }}>Quantité</option>
            <option value="created_at" {{ $sort == 'created_at' ? 'selected' : '' }}>Date ajout</option>
        </select>

        <select name="dir" class="border border-gray-300 rounded px-2 py-1">
            <option value="asc" {{ $direction == 'asc' ? 'selected' : '' }}>Croissant</option>
            <option value="desc" {{ $direction == 'desc' ? 'selected' : '' }}>Décroissant</option>
        </select>

        <select name="per_page" class="border border-gray-300 rounded px-2 py-1">
            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
        </select>

        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Filtrer</button>
        <a href="{{ route('produits.index') }}" class="bg-gray-300 text-gray-700 px-3 py-1 rounded hover:bg-gray-400">Reset</a>
    </form>

    <!-- Tableau responsive -->
    <div class="overflow-x-auto">
        <table class="table-auto w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Nom</th>
                    <th class="px-4 py-2 border">SKU</th>
                    <th class="px-4 py-2 border">Prix achat</th>
                    <th class="px-4 py-2 border">Prix vente</th>
                    <th class="px-4 py-2 border">Quantité</th>
                    <th class="px-4 py-2 border">Image</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $product->name }}</td>
                        <td class="px-4 py-2 border">{{ $product->sku }}</td>
                        <td class="px-4 py-2 border">{{ $product->prix_achat }}</td>
                        <td class="px-4 py-2 border">{{ $product->prix_vente }}</td>
                        <td class="px-4 py-2 border">
                            <form action="{{ route('produits.updateQuantity', $product->id) }}" method="POST" class="flex gap-2">
                                @csrf
                                <input type="number" name="quantite" min="0"
                                    value="{{ $product->quantite }}"
                                    class="w-20 border border-gray-300 rounded px-2 py-1">
                                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">
                                    OK
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-2 border">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 object-cover rounded">
                            @endif
                        </td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('produits.show', $product->id) }}" class="text-blue-500 hover:underline">Voir</a> |
                            <a href="{{ route('produits.edit', $product->id) }}" class="text-green-500 hover:underline">Modifier</a>
                            <form action="{{ route('produits.destroy', $product->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline ml-2">Supprimer</button>
                            </form>                        
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center px-4 py-2">Aucun produit trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    <div class="center">
        <button onclick="window.location='{{ route('produits.create') }}'" class="btn-custom">Ajouter produit</button>
    </div>

    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $products->links('pagination::tailwind') }}
    </div>

</div>
@endsection