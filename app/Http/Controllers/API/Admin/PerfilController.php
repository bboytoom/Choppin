<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdministratorRequest;
use App\Http\Resources\User\UserResource;
use App\Repositories\PerfilRepository;
use App\User;

class PerfilController extends Controller
{
    protected $user;

    public function __construct(PerfilRepository $user)
    {
        $this->user = $user;
    }

    public function show($id)
    {
        $perfil = User::findOrFail($id);

        UserResource::withoutWrapping();
        return new UserResource($perfil);
    }

    public function update(AdministratorRequest $request, $id)
    {
        return response(null, $this->user->updatePerfil($request, $id));
    }
}
