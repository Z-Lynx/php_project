<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use HttpResponses;

    public function index()
    {
        $perPage = 20;
        $products = Product::paginate($perPage);

        return $this->successResponse(
            $products->toArray()['data'],
            '',
            200,
            $products->toArray()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $request->validated();

        $imageName = Str::random(32) . '.' . $request->image_name->getClientOriginalExtension();
        Storage::disk('local')->put('public/product_image/' . $imageName, file_get_contents($request->image_name));

        $request->image_name = $imageName;

        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image_name' => $request->image_name,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
        ]);

        return $this->successResponse(
            $product->toArray(),
            'Product created successfully',
            201
        );

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->errorResponse(
                'Product not found',
                404
            );
        }

        return $this->successResponse(
            new ProductResource($product),
            '',
            200
        );
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
    public function update(Request $request, Product $product)
    {
        if (!$product) {
            return $this->errorResponse(
                'Product not found',
                404
            );
        }

        if ($request->hasFile('image_name')) {
            $imageName = Str::random(32) . '.' . $request->image_name->getClientOriginalExtension();
            Storage::disk('local')->put('public/product_image/' . $imageName, file_get_contents($request->image_name));
            Storage::delete('public/product_image/' . $product->image_name);

            $request->image_name = $imageName;
        }


        $product->update($request->all());

        return $this->successResponse(
            new ProductResource($product),
            'Product updated successfully',
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Delete the associated image
        Storage::delete('public/product_image/' . $product->image_name);

        $product->delete();

        return $this->successResponse(
            null,
            'Product deleted successfully',
            200
        );
    }
}