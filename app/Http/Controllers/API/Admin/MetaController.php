<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MetasRequest;
use App\Repositories\MetasRepository;
use App\Http\Resources\Metas\MetaResource;
use App\Http\Resources\Metas\MetaCollection;
use App\Models\Metas;

class MetaController extends Controller
{
    protected $meta;
    private $pages = 1;

    public function __construct(MetasRepository $meta)
    {
        $this->authorizeResource(Metas::class, 'metum');
        $this->meta = $meta;
    }

    public function index($id)
    {
        $metas = Metas::whereHas('configuration', function ($MetaEstatus) {
            $MetaEstatus->where('status', 1);
        })->paginate($this->pages);

        return new MetaCollection($metas);
    }

    public function show(Metas $metum)
    {
        MetaResource::withoutWrapping();
        return new MetaResource($metum);
    }

    public function update(MetasRequest $request, Metas $metum)
    {
        return response(null, $this->meta->updateMetas($request, $metum));
    }
}
