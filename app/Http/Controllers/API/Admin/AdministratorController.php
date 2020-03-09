<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdministratorRequest;
use App\Repositories\AdministratorRepository;
use App\User;

class AdministratorController extends Controller
{
    protected $user;

    public function __construct(AdministratorRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        //
    }

    public function store(AdministratorRequest $request)
    {
        return response(null, $this->user->createAdministrator($request));
    }

    public function show(User $administration)
    {
        //
    }

    public function update(AdministratorRequest $request, $id)
    {
        return response(null, $this->user->updateAdministrator($request, $id));
    }

    public function destroy($id)
    {
        return response(null, $this->user->deleteAdministrator($id));
    }
}
