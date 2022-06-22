<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
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
        $products = Product::paginate(100);
        return response()->json(['data' => $products, 'message' => 'products fetch successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:200',
                'quantity' => 'required|min:1|numeric',
                'price' => 'required|numeric',
                'description' => 'required|string',
                'product_category' => 'required|string'
            ]);

            $product = Product::create([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'description' => $request->description,
                'product_category' => $request->product_category
            ]);

            return response()->json(['data' => $product, 'message' => 'product created successfully'], 201);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['data' => $product, 'message' => 'product fetch successfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'string|max:200',
            'quantity' => 'min:1|numeric',
            'price' => 'numeric',
            'description' => 'string',
            'product_category' => 'string'
        ]);

        try {

            $product->update($request->all());
            return response()->json(['message' => 'product updated successfully'], 200);

        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return response()->json(['message' => 'product delete successfully'], 200);
    }
}
