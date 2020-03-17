<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;
use App\Repositories\CustomerRepository;
use App\User;

class CustomersController extends Controller
{
    protected $user;
    private $pages = 10;

    public function __construct(CustomerRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $customer = User::where('type', 'cliente')->paginate($this->pages);
        return new UserCollection($customer);
    }

    public function show($id)
    {
        $cliente = User::findOrFail($id);

        UserResource::withoutWrapping();
        return new UserResource($cliente);
    }

    public function update(CustomerRequest $request, $id)
    {
        return response(null, $this->user->updateCustomer($request, $id));
    }

    public function destroy($id)
    {
        return response(null, $this->user->deleteCustomer($id));
    }
}
