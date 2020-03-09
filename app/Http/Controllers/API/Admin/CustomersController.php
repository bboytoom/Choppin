<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use App\User;

class CustomersController extends Controller
{
    protected $user;

    public function __construct(CustomerRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
    }

    public function show(User $cliente)
    {
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
