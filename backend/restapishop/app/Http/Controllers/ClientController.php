<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductClientResource;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\Product;
use App\Models\Carts;
use App\Http\Resources\CartClientResource;

class ClientController extends Controller
{
    use HttpResponses;

    public function getProducts(Request $request)
    {

        $products = Product::paginate(10);
        $productData = ProductClientResource::collection($products);

        return $this->successResponse(
            $productData,
            '',
            200,
            $products->toArray()
        );
    }

    public function getProduct(string $id)
    {
        $product = Product::find($id);
        $productData = new ProductClientResource($product);

        return $this->successResponse(
            $productData,
            '',
            200
        );
    }
    
    public function getCarts(Request $request)
    {
        $carts = Carts::where('user_id', $request->user()->id)->get();
        $carts = CartClientResource::collection($carts);
        return $this->successResponse(
            $carts,
            '',
            200
        );
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required'
        ]);
        
        $cart = Carts::create([
            'user_id' => $request->user()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => Product::find($request->product_id)->sale_price * $request->quantity
        ]);

        return $this->successResponse(
            $cart->toArray(),
            '',
            200
        );
    }

    public function updateCart(Request $request, string $id)
    {
        $cart = Carts::find($id);

        if($request->quantity < 1) {
            $cart->delete();
            return $this->successResponse(
                $cart->toArray(),
                '',
                200
            );
        }

        if ($cart) {
            $cart->quantity = $request->quantity;
            $cart->price = Product::find($cart->product_id)->sale_price * $request->quantity;
            $cart->save();
        }

        return $this->successResponse(
            $cart->toArray(),
            '',
            200
        );
    }

    public function removeFromCart(string $id)
    {
        $cart = Carts::find($id);
        $cart->delete();

        return $this->successResponse(
            $cart->toArray(),
            '',
            200
        );
    }
}
