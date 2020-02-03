<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;
use App\User;

class UserController extends Controller
{

    public function index()
    {
        return new UserCollection(User::paginate(10));
    }

    public function store(UserRequest $request)
    {
        User::create($request->all());
        return response(null, 201);
    }

    public function show(User $user)
    {
        UserResource::withoutWrapping();
        return new UserResource($user);
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        return response(null, 200);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response(null, 204);
    }
}
