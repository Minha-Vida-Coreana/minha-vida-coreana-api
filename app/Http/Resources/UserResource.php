<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
        $created_at = Carbon::parse($this->created_at)->format('Y-m-d H:i:s');
        $updated_at = Carbon::parse($this->updated_at)->format('Y-m-d H:i:s');

        $posts = $this->posts->map(function ($post) {
            return [
                'id'            => $post->id,
                'title'         => $post->title,
                'content'       => $post->content,
                'image'         => $post->image,
                'created_at'    => Carbon::parse($post->created_at)->diffForHumans(),
                'updated_at'    => Carbon::parse($post->updated_at)->diffForHumans(),
            ];
        });
        $posts = $posts->isEmpty() ? 'Este usuário não possui posts ainda' : $posts;

        return [
            'id'            => $this->id,
            'email'         => $this->email,
            'username'      => $this->username,
            'name'          => $this->name,
            'avatar'        => $this->avatar,
            'posts'         => $posts,
            'created_at'    => $created_at,
            'updated_at'    => $updated_at,
        ];
    }
}
