<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;

class AdministratorController extends Controller
{
    public function index()
    {
        //
    }

    public function store(UserRequest $request)
    {
        User::create($request->all());

        return response([
            'message' => 'Se agrego correctamente'
        ], 201);
    }

    public function show(User $user)
    {
        //
    }

    public function update(UserRequest $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
