<?php

namespace App\Http\Controllers\API\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginRequest;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class AuthUserController extends Controller
{
    protected $auth;

    public function __construct(AuthRepository $auth)
    {
        $this->middleware('auth:api')->except('logIn');
        $this->auth = $auth;
    }

    public function logIn(StoreLoginRequest $request)
    {
        return $this->auth->autenticacion($request);
    }

    public function getUser()
    {
        return response()->json(auth()->user());
    }

    public function refreshToken()
    {
        return $this->auth->refresh();
    }

    public function logOut()
    {
        auth()->logout();

        return response()->json(['message' => 'Salió correctamente']);
    }    
}
