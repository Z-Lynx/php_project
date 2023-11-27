<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Models\Product;

class BillResource extends JsonResource
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
            'vn_pay_code' => $this->vn_pay_code,
            'user_id' => User::find($this->user_id)->name,
            'product_id' => Product::find($this->product_id)->name,
            'quantity' => $this->quantity,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];;
    }
}
