<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MetasRequest;
use App\Repositories\MetasRepository;
use Illuminate\Http\Request;
use App\Models\Metas;

class MetaController extends Controller
{
    protected $meta;

    public function __construct(MetasRepository $meta)
    {
        $this->meta = $meta;
    }

    public function index($id)
    {
        //
    }

    public function show(Metas $metum)
    {
        //
    }

    public function update(MetasRequest $request, $id)
    {
        return response(null, $this->meta->updateMetas($request, $id));
    }
}
