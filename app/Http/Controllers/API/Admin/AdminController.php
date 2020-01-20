<?php

namespace App\Http\Controllers\API\Admin;

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
    public function index(Request $request)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            return new AdminCollection(Admin::paginate(10));
        } else {
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            Admin::create($request->all());
            return response(null, 201);
        } else {
            abort(401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Admin $admin)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            AdminResource::withoutWrapping();
            return new AdminResource($admin);
        } else {
            abort(401);
        }
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
        if (config('app.key') == $request->header('x-api-key')) {
            $admin->update($request->all());
            return response(null, 200);
        } else {
            abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Admin $admin)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $admin->delete();
            return response(null, 204);
        } else {
            abort(401);
        }
    }
}
