<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'product_id' => Product::find($this->product_id)->slug,
            'image' => filter_var($this->image, FILTER_VALIDATE_URL) ? $this->image : url('/api/images/' . basename($this->image)),
            'updated_at' => $this->updated_at,
        ];
    }
}
