<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Product;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Ajouter un produit au panier (session)
     */
    public function storeInSession(CartRequest $request)
    {
        // dd(auth()->user());
        dd(Auth::user());

        // if ($errors = $request->errors()) {
        //     dd($errors);
        // }

        
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $userId = $user->id;

        $product = Product::findOrFail($request->product_id);

        $cart = session()->get('cart', []);

        if (!isset($cart['user_id'])) {
            $cart['user_id'] = $userId;
        }

        if (isset($cart['items'][$product->id])) {
            $cart['items'][$product->id]['quantity'] += $request->quantity;
        } else {
            $cart['items'][$product->id] = [
                'product_id' => $product->id,
                'titre' => $product->titre,
                'prix' => $product->prix,
                'image' => $product->image,
                'quantity' => $request->quantity
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Produit ajouté au panier',
            'cart' => session('cart')
        ], 200);
    }

    /**
     * Récupérer les articles du panier
     */
    public function getCart()
    {
        return response()->json([
            'cart' => session('cart', [])
        ]);
    }

    /**
     * Supprimer un article du panier
     */
    public function removeFromCart($product_id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'message' => 'Produit supprimé du panier',
            'cart' => session('cart')
        ]);
    }

    /**
     * Vider le panier
     */
    public function clearCart()
    {
        session()->forget('cart');

        return response()->json([
            'message' => 'Panier vidé avec succès'
        ]);
    }
}
