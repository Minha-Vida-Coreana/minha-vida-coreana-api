<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class StoreUserController extends Controller
{
    use HttpResponses;

    public function __invoke(Request $request)
    {
        $storeUserRequest = new StoreUserRequest();

        $validator = Validator::make($request->all(), $storeUserRequest->rules());

        if ($validator->fails()) {
            return $this->error('Erro de validação', Response::HTTP_BAD_REQUEST, $validator->errors());
        }

        $user = User::create($validator->validated());

        if (!$user) {
            return $this->error('Erro ao criar usuário', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // if ($request->hasFile('avatar')) {
        //     $file = $request->file('avatar');
        //     $fileName = $file->getClientOriginalName();
        //     $filePath = 'avatars/' . $user->id . '/' . $fileName;
        //     $disk = env('APP_ENV') === 'production' ? 's3' : 'local';
        //     Storage::disk($disk)->put($filePath, file_get_contents($file), 'public');
        //     $user->update(['avatar' => $filePath]);
        // }


        return $this->response('Usuário criado com sucesso', Response::HTTP_CREATED, new UserResource($user));
    }
}
