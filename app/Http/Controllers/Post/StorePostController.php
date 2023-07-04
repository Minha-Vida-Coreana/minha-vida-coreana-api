<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StorePostController extends Controller
{
    use HttpResponses;

    public function __invoke(Request $request)
    {
        $storePostRequest = new StorePostRequest();

        $validator = Validator::make($request->all(), $storePostRequest->rules());

        if ($validator->fails()) {
            return $this->error('Erro de validação', Response::HTTP_BAD_REQUEST, $validator->errors());
        }

        $post = new Post($validator->validated());
        $post->setSlugAttribute($post->title);
        $post->user_id = Auth::id();
        $post->save();

        $post->categories()->attach($request->category_id);

        return $this->response('Post criado com sucesso', Response::HTTP_CREATED, new PostResource($post));
    }
}
