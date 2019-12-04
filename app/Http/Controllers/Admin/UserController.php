<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SaveUserRequest;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(SaveUserRequest $request)
    {
        $data = [
            'name'          => $request->get('name'),
            'father_surname'     => $request->get('father_surname'),
            'mother_surname'     => $request->get('mother_surname'),
            'email'         => $request->get('email'),
            'password'      => \Hash::make($request->get('password')),
            'type'          => $request->get('type'),
            'active'        => $request->has('active') ? 1 : 0
        ];

        $user = User::create($data);
        
        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'      => 'required|max:100',
            'father_surname' => 'required|max:100',
            'mother_surname' => 'max:100',
            'email'     => 'required|email',
            'password'  => ($request->get('password') != "") ? 'required|confirmed' : "",
            'type'      => 'required|in:user,admin',
        ]);
        
        $user->name = $request->get('name');
        $user->father_surname = $request->get('father_surname');
        $user->mother_surname = $request->get('mother_surname');
        $user->email = $request->get('email');
        $user->type = $request->get('type');
        $user->active = $request->has('active') ? 1 : 0;
        
        if($request->get('password') != "") 
            $user->password = \Hash::make($request->get('password'));
        
        $updated = $user->save();
        
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(User $user)
    {
        $deleted = $user->delete();
        
        return redirect()->route('admin.user.index');
    }
}