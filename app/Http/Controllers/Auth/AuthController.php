<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(Request $request)
    {
        $loginRequest = new LoginRequest();

        $validator = Validator::make($request->all(), $loginRequest->rules());

        if ($validator->fails()) {
            return $this->error('Erro de validação', Response::HTTP_BAD_REQUEST, $validator->errors());
        }

        if (!Auth::attempt($validator->validated())) {
            return $this->error('Credenciais inválidas', Response::HTTP_UNAUTHORIZED);
        }

        return $this->response('Login realizado com sucesso', Response::HTTP_OK, [
            'token' => Auth::user()->createToken('auth_token')->plainTextToken
        ]);
    }

    // Accept = application/json
    public function logout()
    {
        auth('sanctum')->user()->tokens()->delete();

        return $this->response('Logout realizado com sucesso', Response::HTTP_OK);
    }
}
