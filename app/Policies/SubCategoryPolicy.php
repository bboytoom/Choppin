<?php

namespace App\Policies;

use App\Models\SubCategory;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubCategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('read-subcategory');
    }

    public function view(User $user, SubCategory $subcategory)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('detail-subcategory');
    }

    public function create(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('create-subcategory');
    }


    public function update(User $user, SubCategory $subcategory)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('update-subcategory');
    }

    public function delete(User $user, SubCategory $subcategory)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('delete-subcategory');
    }
}
