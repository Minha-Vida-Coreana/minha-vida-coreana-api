<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UpdatePostController extends Controller
{
    use HttpResponses;

    public function __invoke(Request $request, string $id)
    {
        $updatePostRequest = new UpdatePostRequest();

        $validator = Validator::make($request->all(), $updatePostRequest->rules());

        if ($validator->fails()) {
            return $this->error('Erro de validação', Response::HTTP_BAD_REQUEST, $validator->errors());
        }

        $post = Post::find($id);

        if (!$post) {
            return $this->error('Post não encontrado', Response::HTTP_NOT_FOUND);
        }

        $post->update($validator->validated());
        return $this->response('Post atualizado com sucesso', Response::HTTP_OK, $post);
    }
}
