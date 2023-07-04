<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UpdateUserController extends Controller
{
    use HttpResponses;

    public function __invoke(Request $request, string $id)
    {
        $updateUserRequest = new UpdateUserRequest();

        $validator = Validator::make($request->all(), $updateUserRequest->rules());

        if ($validator->fails()) {
            return $this->error('Erro de validação', Response::HTTP_BAD_REQUEST, $validator->errors());
        }

        $user = User::find($id);

        if (!$user) {
            return $this->error('Usuário não encontrado', Response::HTTP_NOT_FOUND);
        }

        $user->update($validator->validated());

        return $this->response('Usuário atualizado com sucesso', Response::HTTP_OK, $user);
    }
}
