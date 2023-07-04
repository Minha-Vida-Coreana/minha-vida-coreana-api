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
            return $this->error('Validation error', Response::HTTP_UNPROCESSABLE_ENTITY, $validator->errors());
        }

        $user = User::create($validator->validated());

        return $this->response('User created successfully', Response::HTTP_CREATED, new UserResource($user));
    }
}
