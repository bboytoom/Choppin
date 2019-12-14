<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminUserRequest;
use App\Http\Resources\AdminUserResource;
use App\Http\Resources\AdminUserCollection;
use App\User;

class UsersController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new AdminUserCollection(User::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request)
    {
        $user = User::create($request->all());

        return response()->json(
        [
            'data' => [
                'user' => [
                    'name' => $user->name,
                    'mother_surname' => $user->mother_surname,
                    'father_surname' => $user->father_surname
                ],
                'password' => '@Usuario2907'
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        AdminUserResource::withoutWrapping();
        return new AdminUserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, User $user)
    {
        $user->update($request->all());
        
        return response()->json(
        [
            'data' => $user
        ], 200);    
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
