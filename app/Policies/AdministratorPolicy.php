<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdministratorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('read-administration');
    }

    public function view(User $user, User $model)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('detail-administration');
    }

    public function create(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('create-administration');
    }

    public function update(User $user, User $model)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('update-administration');
    }

    public function delete(User $user, User $model)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('delete-administration');
    }
}
