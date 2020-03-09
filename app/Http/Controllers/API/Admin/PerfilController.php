<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdministratorRequest;
use App\Repositories\PerfilRepository;
use Illuminate\Http\Request;
use App\User;

class PerfilController extends Controller
{
    protected $user;

    public function __construct(PerfilRepository $user)
    {
        $this->user = $user;
    }

    public function show(User $perfil)
    {
    }

    public function update(AdministratorRequest $request, $id)
    {
        return response(null, $this->user->updatePerfil($request, $id));
    }
}
