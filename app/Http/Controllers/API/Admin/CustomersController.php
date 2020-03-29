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
        $this->authorizeResource(User::class, 'cliente');
        $this->user = $user;
    }

    public function index()
    {
        $customer = User::where('type', 'cliente')->paginate($this->pages);
        return new UserCollection($customer);
    }

    public function show(User $cliente)
    {
        UserResource::withoutWrapping();
        return new UserResource($cliente);
    }

    public function update(CustomerRequest $request, User $cliente)
    {
        return response(null, $this->user->updateCustomer($request, $cliente));
    }

    public function destroy(User $cliente)
    {
        return response(null, $this->user->deleteCustomer($cliente));
    }
}
