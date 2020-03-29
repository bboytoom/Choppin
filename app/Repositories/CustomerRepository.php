<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\User;

class CustomerRepository
{
    public function updateCustomer(Request $request, $cliente)
    {
        try {
            $customer = User::where('id', $cliente->id)->update([
                'name' => e(strtolower($request->name)),
                'mother_surname' => empty($request->mother_surname) ? '' : e(strtolower($request->mother_surname)),
                'father_surname' => e(strtolower($request->father_surname)),
                'email' => e(strtolower($request->email)),
                'password' => empty($request->password) ? $cliente->password : \Hash::make($request->password),
                'status' => $request->status
            ]);

            if ($customer) {
                Log::notice('El cliente ' . $request->name . ' se actualizo correctamente');
                return 200;
            }

            Log::warning('El cliente ' . $request->name . ' no se actualizo');
            return 400;
        } catch (\Exception $e) {
            Log::error('Error al actualizar el cliente ' . $request->name . ', ya que muestra la siguiente Exception ' . $ee->getMessage());
        }
    }

    public function deleteCustomer($customer)
    {
        $cus = $customer->delete();
        
        if ($cus) {
            Log::notice('El cliente ' . $customer->email . ' se elimino correctamente');
            return 204;
        }
        
        Log::warning('El cliente ' . $customer->email . ' no se eliminox');
        return 400;
    }
}
