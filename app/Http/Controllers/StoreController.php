<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configuration;

class StoreController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $configuracion = Configuration::where('status', 1)->first();

        return view('store', [
            'sitio' => $configuracion['name']
        ]);
    }
}
