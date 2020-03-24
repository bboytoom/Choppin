<?php

namespace App\Policies;

use App\Models\Permission;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('read-permission');
    }

    public function view(User $user, Permission $permission)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('detail-permission');
    }

    public function create(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('create-permission');
    }

    public function update(User $user, Permission $permission)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('update-permission');
    }

    public function delete(User $user, Permission $permission)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('delete-permission');
    }
}
