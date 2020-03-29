<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('read-custommer');
    }

    public function view(User $user, User $model)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('detail-custommer');
    }

    public function create(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('create-custommer');
    }

    public function update(User $user, User $model)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('update-custommer');
    }

    public function delete(User $user, User $model)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('delete-custommer');
    }
}
