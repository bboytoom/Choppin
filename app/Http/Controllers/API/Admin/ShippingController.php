<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ShippingRequest;
use App\Http\Resources\Shipping\ShippingResource;
use App\Http\Resources\Shipping\ShippingCollection;
use App\Repositories\ShippingRepository;
use App\Models\Shipping;

class ShippingController extends Controller
{
    protected $shippin;
    private $pages = 10;

    public function __construct(ShippingRepository $shippin)
    {
        $this->authorizeResource(Shipping::class, 'envio');
        $this->shippin = $shippin;
    }

    public function index($id)
    {
        $shippings = Shipping::whereHas('user', function ($shippingsEstatus) {
            $shippingsEstatus->where('status', 1);
        })->where('user_id', $id)->paginate($this->pages);

        return new ShippingCollection($shippings);
    }

    public function store(ShippingRequest $request)
    {
        return response(null, $this->shippin->createShipping($request));
    }

    public function show(Shipping $envio)
    {
        ShippingResource::withoutWrapping();
        return new ShippingResource($envio);
    }

    public function update(ShippingRequest $request, Shipping $envio)
    {
        return response(null, $this->shippin->updateShipping($request, $envio));
    }

    public function destroy(Shipping $envio)
    {
        return response(null, $this->shippin->deleteShipping($envio));
    }
}
