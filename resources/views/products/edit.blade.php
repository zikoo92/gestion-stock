<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Modifier le produit</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produits.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1">Nom du produit</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">SKU (code unique)</label>
            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Prix d'achat</label>
            <input type="number" step="0.01" name="prix_achat" value="{{ old('prix_achat', $product->prix_achat) }}"
                   class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Prix de vente</label>
            <input type="number" step="0.01" name="prix_vente" value="{{ old('prix_vente', $product->prix_vente) }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Quantité</label>
            <input type="number" name="quantite" value="{{ old('quantite', $product->quantite) }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Image du produit</label>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="w-20 h-20 object-cover rounded mb-2">
            @endif
            <input type="file" name="image" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Mettre à jour
        </button>
    </form>
</div>