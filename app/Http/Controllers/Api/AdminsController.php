<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminUserRequest;
use App\Http\Resources\AdminUserResource;
use App\Http\Resources\AdminUserCollection;
use App\Admin;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new AdminUserCollection(Admin::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request)
    {
        $admin = Admin::create([
            'name' => $request->get('name'),
            'mother_surname' => $request->get('mother_surname'),
            'father_surname' => $request->get('father_surname'),
            'email' => $request->get('email'),
            'password' => \Hash::make('@Admins2907'),
            'status' => $request->get('status')
        ]);

        return response()->json(
        [
            'data' => [
                'admins' => [
                    'name' => $admin->name,
                    'mother_surname' => $admin->mother_surname,
                    'father_surname' => $admin->father_surname
                ],
                'password' => '@Admins2907'
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admins =  Admin::find($id);

        AdminUserResource::withoutWrapping();
        return new AdminUserResource($admins);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, $id)
    {
        $admin =  Admin::find($id);
        $admin->name = $request->get('name');
        $admin->mother_surname = $request->get('mother_surname');
        $admin->father_surname = $request->get('father_surname');
        $admin->email = $request->get('email');
        $admin->status = $request->get('status');
        $admin->save();

        return response(null, 200);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin =  Admin::find($id);
        $admin->delete();
        
        return response(null, 204);
    }
}
