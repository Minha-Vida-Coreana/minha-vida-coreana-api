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

        $comments = $this->comments->map(function ($comment) {
            return [
                'id'        => $comment->id,
                'content'   => $comment->content,
                'user'      => $comment->user->name,
                'user_id'   => $comment->user_id,
                'created_at' => Carbon::parse($comment->created_at)->diffForHumans(),
                'updated_at' => Carbon::parse($comment->updated_at)->diffForHumans(),
            ];
        });
        $comments = $comments->isEmpty() ? null : $comments;

        $categories = $this->categories->map(function ($category) {
            return [
                'id'        => $category->id,
                'name'      => $category->name,
            ];
        });
        $categories = $categories->isEmpty() ? null : $categories;

        return [
            'id'                => $this->id,
            'title'             => $this->title,
            'slug'              => $this->slug,
            'content'           => $this->content,
            'user'              => $this->user->name,
            'user_id'           => $this->user_id,
            'comments_count'    => $this->comments->count(),
            'comments'          => $comments,
            'categories_count'  => $this->categories->count(),
            'categories'        => $categories,
            'created_at'        => $created_at,
            'updated_at'        => $updated_at,
        ];
    }
}
