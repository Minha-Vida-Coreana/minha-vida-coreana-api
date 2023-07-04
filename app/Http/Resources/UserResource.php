<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $created_at = $this->created_at->format('Y-m-d H:i:s');
        $updated_at = $this->updated_at->format('Y-m-d H:i:s');
        return [
            'id'            => $this->id,
            'email'         => $this->email,
            'username'      => $this->username,
            'name'          => $this->name,
            'avatar'        => $this->avatar,
            'created_at'    => $created_at,
            'updated_at'    => $updated_at,
        ];
    }
}
