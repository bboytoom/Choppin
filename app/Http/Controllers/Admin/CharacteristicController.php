<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Characteristic;

class CharacteristicController extends Controller
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
    public function index($id)
    {
        $characteristic =  Characteristic::findOrFail(base64_decode($id));

        return view('admin.characteristic.index', [
            'id' => $characteristic['id']
        ]);
    }
}
