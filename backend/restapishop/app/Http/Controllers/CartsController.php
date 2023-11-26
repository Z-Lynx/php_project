<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Product;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Models\Carts;

class CartsController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Carts::all();
        $carts = CartResource::collection($carts);
        return $this->successResponse(
            $carts,
            '',
            200,
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        $product = Product::find($request->product_id);

        $request->merge([
            'price' => $product->sale_price * $request->quantity,
        ]);

        $cart = Carts::create($request->all());

        return $this->successResponse(
            new CartResource($cart),
            'Cart created successfully',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cart = Carts::find($id);
        if (!$cart) {
            return $this->errorResponse(
                'Cart not found',
                404
            );
        }

        $product = Product::find($request->product_id);

        $request->merge([
            'price' => $product->sale_price * $request->quantity,
        ]);

        $cart->update($request->all());

        return $this->successResponse(
            new CartResource($cart),
            'Cart updated successfully',
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Carts::find($id);
        if (!$cart) {
            return $this->errorResponse(
                'Cart not found',
                404
            );
        }

        $cart->delete();

        return $this->successResponse(
            new CartResource($cart),
            'Cart deleted successfully',
            200
        );
    }
}
