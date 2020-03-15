<?php

namespace App\Http\Controllers\API\Store;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginRequest;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class AuthUserController extends Controller
{
    use ThrottlesLogins;

    protected $auth;
    protected $maxAttempts = 3;
    protected $decayMinutes = 1;

    public function __construct(AuthRepository $auth)
    {
        $this->middleware('auth:api')->except('logIn');
        $this->auth = $auth;
    }

    public function logIn(StoreLoginRequest $request)
    {
        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if (!$this->auth->autenticacion($request)) {
            $this->incrementLoginAttempts($request);
            return response(null, 401);
        }

        $this->clearLoginAttempts($request);
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

    public function username()
    {
        return 'email';
    }
}
