<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PerfilRequest;
use App\Http\Resources\User\UserResource;
use App\Repositories\PerfilRepository;
use App\User;

class PerfilController extends Controller
{
    protected $user;

    public function __construct(PerfilRepository $user)
    {
        $this->authorizeResource(User::class, 'perfil');
        $this->user = $user;
    }

    public function show(User $perfil)
    {
        UserResource::withoutWrapping();
        return new UserResource($perfil);
    }

    public function update(PerfilRequest $request, User $perfil)
    {
        return response(null, $this->user->updatePerfil($request, $perfil));
    }
}
