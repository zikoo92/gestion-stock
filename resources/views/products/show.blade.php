<div class="container">
    <h1>Détails du produit</h1>

    <div style="margin-top: 20px;">

        <p><strong>Nom :</strong> {{ $product->name }}</p>

        <p><strong>SKU :</strong> {{ $product->sku }}</p>

        <p><strong>Prix d'achat :</strong>
            {{ $product->prix_achat ?? '—' }} DA
        </p>

        <p><strong>Prix de vente :</strong>
            {{ $product->prix_vente }} DA
        </p>

        <p><strong>Quantité :</strong> {{ $product->quantite }}</p>

        <p><strong>Image :</strong></p>

        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" width="150" style="border-radius: 5px;">
        @else
            <p>Aucune image</p>
        @endif

        <br><br>

        <a href="{{ route('produits.edit', $product->id) }}">Modifier</a> |
        <a href="{{ route('produits.index') }}">Retour à la liste</a>

    </div>
</div>