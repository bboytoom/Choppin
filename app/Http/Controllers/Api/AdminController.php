<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Http\Resources\Admin\AdminCollection;
use App\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new AdminCollection(Admin::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $admin = Admin::create([
            'name' => strip_tags($request->get('name')),
            'mother_surname' => strip_tags($request->get('mother_surname')),
            'father_surname' => strip_tags($request->get('father_surname')),
            'email' => strip_tags($request->get('email')),
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
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        AdminResource::withoutWrapping();
        return new AdminResource($admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        $admin->name = strip_tags($request->get('name'));
        $admin->mother_surname = strip_tags($request->get('mother_surname'));
        $admin->father_surname = strip_tags($request->get('father_surname'));
        $admin->email = strip_tags($request->get('email'));
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
    public function destroy(Admin $admin)
    {
        $admin->delete();
        
        return response(null, 204);
    }
}
