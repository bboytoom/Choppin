<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\User;

class CustomerRepository
{
    public function updateCustomer(Request $request)
    {
        User::where('id', $request->id)->update($request->except(['password_confirmation']));
        return 200;
    }

    public function deleteCustomer($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return 204;
    }
}
