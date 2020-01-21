<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configuration;

class ConfigurationController extends Controller
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
        return view('admin.configurations.index');
    }

    public function edit($id)
    {
        $configuration =  Configuration::findOrFail(base64_decode($id));

        return view('admin.configurations.edit', [
            'id' => $configuration['id']
        ]);
    }
}
