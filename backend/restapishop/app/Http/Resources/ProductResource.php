<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Categories;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => (string) $this->description,
            'image' => filter_var($this->image, FILTER_VALIDATE_URL) ? $this->image : url('/api/images/' . basename($this->image)),
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'slug' => $this->slug,
            'category_id' => Categories::find($this->category_id)->slug,
            'updated_at' => $this->updated_at,
        ];
    }
}
