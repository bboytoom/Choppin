<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdministratorRequest;
use App\Repositories\AdministratorRepository;
use App\User;

class AdministratorController extends Controller
{
    protected $usuario;

    public function __construct(AdministratorRepository $usuario)
    {
        $this->usuario = $usuario;
    }

    public function index()
    {
        //
    }

    public function store(AdministratorRequest $request)
    {
        return response(null, $this->usuario->createAdministrator($request));
    }

    public function show(User $administration)
    {
        //
    }

    public function update(AdministratorRequest $request, User $administration)
    {
        return response(null, $this->usuario->updateAdministrator($request));
    }

    public function destroy($id)
    {
        return response(null, $this->usuario->deleteAdministrator($id));
    }
}
