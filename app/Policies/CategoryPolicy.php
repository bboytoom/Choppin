<?php

namespace App\Policies;

use App\Models\Category;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('read-category');
    }

    public function view(User $user, Category $category)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('detail-category');
    }

    public function create(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('create-category');
    }

    public function update(User $user, Category $category)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('update-category');
    }

    public function delete(User $user, Category $category)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('delete-category');
    }
}
