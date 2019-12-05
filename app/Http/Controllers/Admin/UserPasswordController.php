<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SaveUserPaswordRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserPasswordController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $password = User::find($id);

        return view('admin.password.edit', [
            'password' => $password
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveUserPaswordRequest $request, $id)
    {
        $password = User::find($id);
        $password->password = \Hash::make($request->get('password'));
        $password->save();

        return redirect()->route('admin.user.index');
    }
}
