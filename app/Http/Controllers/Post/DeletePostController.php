<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeletePostController extends Controller
{
    use HttpResponses;

    public function __invoke(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return $this->error('Post não encontrado', Response::HTTP_NOT_FOUND);
        }

        $post->delete();
        return $this->response('Post deletado com sucesso', Response::HTTP_NO_CONTENT);
    }
}
