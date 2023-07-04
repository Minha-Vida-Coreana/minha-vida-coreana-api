<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $created_at = Carbon::parse($this->created_at)->diffForHumans();
        $updated_at = Carbon::parse($this->updated_at)->diffForHumans();
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'slug'          => $this->slug,
            'content'       => $this->content,
            'user'          => $this->user->name,
            'user_id'       => $this->user_id,
            'created_at'    => $created_at,
            'updated_at'    => $updated_at,
        ];
    }
}
