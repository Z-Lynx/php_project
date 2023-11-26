<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageProducts;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Resources\ImageResource;
class ImageProductsController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imageProducts = ImageProducts::all();
        $imageProducts = ImageResource::collection($imageProducts);

        return $this->successResponse(
            $imageProducts,
            '',
            200
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
            'product_id' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4048',
        ]);
        
        $imageName = Str::random(32) . '.' . $request->image->getClientOriginalExtension();
        Storage::disk('local')->put('public/product_image/' . $imageName, file_get_contents($request->image));

        $requestData = $request->all();
        $requestData['image'] = $imageName;

        // Create the product
        $product = ImageProducts::create($requestData);

        return $this->successResponse(
            new ImageResource($product),
            'Product created successfully',
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
        $imageProduct = ImageProducts::find($id);

        if(!$imageProduct) {
            return $this->errorResponse(
                'Product not found',
                404
            );
        }

        $requestData = $request->all();

        if($request->hasFile('image')) {
            $imageName = Str::random(32) . '.' . $request->image->getClientOriginalExtension();
            Storage::disk('local')->put('public/product_image/' . $imageName, file_get_contents($request->image));
            $requestData['image'] = $imageName;

            // Delete the associated image
            Storage::delete('public/product_image/' . $imageProduct->image);
        }

        $imageProduct->update($requestData);

        return $this->successResponse(
            new ImageResource($imageProduct),
            'Product updated successfully',
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imageProduct = ImageProducts::find($id);

        if(!$imageProduct) {
            return $this->errorResponse(
                'Product not found',
                404
            );
        }

        // Delete the associated image
        Storage::delete('public/product_image/' . $imageProduct->image);

        $imageProduct->delete();

        return $this->successResponse(
            new ImageResource($imageProduct),
            'Product deleted successfully',
            200
        );
    }
}
