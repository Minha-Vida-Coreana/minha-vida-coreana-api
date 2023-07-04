<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\HttpResponses;

class ShowUserController extends Controller
{
    use HttpResponses;

    public function __invoke(string $id)
    {
        $user = User::with('posts')->find($id);

        if (!$user) {
            return $this->error('Usuário não encontrado', 404);
        }

        return $this->response('Usuário encontrado com sucesso', 200, new UserResource($user));
    }
}
