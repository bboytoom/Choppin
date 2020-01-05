<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UserCollection(User::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        User::create([
            'name' => strip_tags($request->get('name')),
            'mother_surname' => strip_tags($request->get('mother_surname')),
            'father_surname' => strip_tags($request->get('father_surname')),
            'email' => strip_tags($request->get('email')),
            'password' => \Hash::make('@User2907'),
            'status' => 1
        ]);

        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        UserResource::withoutWrapping();
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->name = strip_tags($request->get('name'));
        $user->mother_surname = strip_tags($request->get('mother_surname'));
        $user->father_surname = strip_tags($request->get('father_surname'));
        $user->email = strip_tags($request->get('email'));
        $user->status = $request->get('status');
        $user->save();
        
        return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response(null, 204);
    }
}
