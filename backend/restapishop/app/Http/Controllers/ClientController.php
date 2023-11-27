<?php

namespace App\Http\Controllers;

use App\Http\Resources\BillResource;
use App\Http\Resources\ProductClientResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\Product;
use App\Models\Carts;
use App\Http\Resources\CartClientResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Bills;

class ClientController extends Controller
{
    use HttpResponses;

    public function updateInfo(Request $request)
    {
        if ($request->has('password')) {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|min:8',
            ]);
            $user = $request->user();

            if (!Hash::check($request->current_password, $user->password)) {
                return $this->errorResponse(
                    'Mật khẩu hiện tại không đúng',
                    400
                );
            }

            $user->password = Hash::make($request->password);
        }

        if ($request->has('name')) {
            $request->validate([
                'name' => 'required',
            ]);
            $user = $request->user();
            $user->name = $request->name;
        }

        if ($request->has('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:4048',
            ]);

            $imageName = Str::random(32) . '.' . $request->image->getClientOriginalExtension();
            Storage::disk('local')->put('public/images/' . $imageName, file_get_contents($request->image));

            $user = $request->user();
            $user->avatar = $imageName;
        }

        $user->save();

        return $this->successResponse(
            new UserResource($user),
            'Cập nhật thành công',
            200
        );
    }
    public function myOrder(Request $request)
    {
        $bill = Bills::where('user_id', $request->user()->id)->get();
        $bill = BillResource::collection($bill);
        return $this->successResponse(
            $bill,
            '',
            200
        );
    }
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

        if ($request->quantity < 1) {
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
