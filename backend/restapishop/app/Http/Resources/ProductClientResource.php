<?php

namespace App\Http\Resources;

use App\Models\Categories;
use App\Models\ImageProducts;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $image = filter_var($this->image, FILTER_VALIDATE_URL) ? $this->image : url('/api/images/' . basename($this->image));
        $imageDetail = ImageProductClientResource::collection(ImageProducts::where('product_id', $this->id)->get());

        return [
            'id' => $this->id,
            'category' => Categories::find($this->category_id),
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'image' => $image,
            'image_detail'=> $imageDetail,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
