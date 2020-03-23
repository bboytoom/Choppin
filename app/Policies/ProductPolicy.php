<?php

namespace App\Policies;

use App\Models\Product;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('read-product');
    }

    public function view(User $user, Product $product)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('detail-product');
    }

    public function create(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('create-product');
    }

    public function update(User $user, Product $product)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('update-product');
    }

    public function delete(User $user, Product $product)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('delete-product');
    }
}
