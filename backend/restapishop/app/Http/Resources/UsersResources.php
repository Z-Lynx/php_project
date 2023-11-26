<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResources extends JsonResource
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
            'email' => $this->email,
            'is_active' => $this->email_verified_at !== null,
            'auth_type' => $this->auth_type,
            'avatar' => filter_var($this->avatar, FILTER_VALIDATE_URL) ? $this->avatar : url('/api/images/' . basename($this->avatar)),
            'is_admin' => $this->is_admin === 0 ? false : true,
            'fcm_id' => $this->fcm_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
