<?php

namespace App\Policies;

use App\Models\Shipping;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShippingPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('read-shipping');
    }

    public function view(User $user, Shipping $shipping)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('detail-shipping');
    }

    public function create(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('create-shipping');
    }

    public function update(User $user, Shipping $shipping)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('update-shipping');
    }

    public function delete(User $user, Shipping $shipping)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('delete-shipping');
    }
}
