<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'image' => filter_var($this->image_name, FILTER_VALIDATE_URL) ? $this->image_name : url('/api/images/' . basename($this->image_name)),
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'slug' => $this->slug,
        ];
    }
}
