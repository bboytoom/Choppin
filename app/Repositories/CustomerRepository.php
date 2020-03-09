<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\User;

class CustomerRepository
{
    public function updateCustomer(Request $request, $id)
    {
        $user = User::find($id);

        if(is_null($user)) {
            return 422;
        }

        User::where('id', $user->id)->update($request->except(['password_confirmation']));
        return 200;
    }

    public function deleteCustomer($id)
    {
        $user = User::find($id);

        if(is_null($user)) {
            return 422;
        }

        $user->delete();
        return 204;
    }
}
