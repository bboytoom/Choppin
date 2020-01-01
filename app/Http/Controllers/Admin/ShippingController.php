<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingController extends Controller
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
        $shipping =  Shipping::find(base64_decode($id));

        if ($shipping == null) {
            return response(null, 404);
        }

        return view('admin.shippings.index', [
            'id' => $shipping['id']
        ]);
    }
}
