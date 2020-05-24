<?php

namespace App\Http\Controllers\API\Store;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Resources\Store\AuthResource;
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
        $myUser = User::where('email', e(strtolower($request->email)))->where('status', 1)->first();

        if (is_null($myUser)) {
            return response(null, 204);
        }

        if ($myUser->cicle == 3) {
            User::where('id', $myUser->id)->update(['status' => 0, 'cicle' => 0 ]);
            Log::warning('El usuario ' . $request->email . ' Fue bloqueado permanentemente por el sistema');
                
            return response(null, 423);
        }

        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            User::where('id', $myUser->id)->update(['cicle' => $myUser->cicle + 1 ]);
            Log::alert('El usuario ' . $request->email . ' Fue bloqueado temporalmente por el sistema');

            return $this->sendLockoutResponse($request);
        }

        if (!$this->auth->autenticacion($request)) {
            $this->incrementLoginAttempts($request);
            Log::info('Intento fallido del usuario ' . $request->email);

            return response(null, 401);
        }

        $this->clearLoginAttempts($request);
        User::where('id', $myUser->id)->update(['cicle' => 0 ]);

        return $this->auth->autenticacion($request);
    }

    public function getUser()
    {
        AuthResource::withoutWrapping();
        return new AuthResource(auth()->user());
    }

    public function refreshToken()
    {
        return $this->auth->refresh();
    }

    public function logOut()
    {
        $user = auth()->user();
        User::where('id', $user->id)->update(['remember' => 0]);

        auth()->logout();
        return response(['message' => trans('services.logout_message')], 401);
    }

    public function username()
    {
        return 'email';
    }
}
