<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    public function edit($id)
    {
        $user =  User::findOrFail(base64_decode($id));

        return view('admin.users.edit', [
            'id' => $id,
            'name' => $user['name'],
            'paterno' => $user['father_surname'],
            'materno' => $user['mother_surname'],
        ]);
    }
}
