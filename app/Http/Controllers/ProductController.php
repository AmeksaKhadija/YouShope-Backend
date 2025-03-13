<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $fields = $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric',
            'image' => 'required',
            'id_categorie' => 'required',
        ]);
        if (!$fields) {
            return response()->json([
                'status' => 422,
                'errors' => $fields->message(),
            ], 422);
        } else {

            $product = Product::create($fields);

            return response()->json([
                'message' => 'produit ajoutée avec succès',
                'product' => $product
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }
        return response()->json([
            'product' => $product
        ]);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json([
            'message' => 'produit avec id ' . $id . ' est:',
            'product' => $product
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $fields = $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'prix' => 'required',
            'image' => 'required',
            'id_categorie' => 'required',
        ]);

        $product->update($fields);

        return response()->json([
            'message' => 'produit mise à jour avec succès',
            'product' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'product not found'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'produit supprimée avec succès']);
    }


    // public function test(Request $request){
    //     return response()->json($request);
    // }
}
