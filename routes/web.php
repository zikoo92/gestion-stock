<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\controllers\ProductController;

Route::get('/', [ProductController::class, 'index']);


Route::resource('/produits',ProductController::class);
Route::post('/produits/{produit}/quantite', [ProductController::class, 'updateQuantity'])->name('produits.updateQuantity');
Route::post('/produits/{produit}/quantite', [ProductController::class, 'updateQuantity'])->name('produits.updateQuantity');