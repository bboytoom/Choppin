<?php

namespace App\Http\Controllers\API\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\indexRepository;

class IndexController extends Controller
{
    protected $index;
    private $pages = 10;

    public function __construct(indexRepository $index)
    {
        $this->middleware('shoppingcart')->only('store');
        $this->index = $index;
    }

    public function store(Request $request)
    {
        return response(null, $this->index->createShopping($request, $request->shopping_cart));
    }
}
