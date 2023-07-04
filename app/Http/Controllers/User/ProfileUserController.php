<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileUserController extends Controller
{
    public function __invoke()
    {
        return response()->json(auth()->user()->with('posts')->first());
    }
}
