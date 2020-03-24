<?php

namespace App\Policies;

use App\Models\Configuration;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigurationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('read-configuration');
    }

    public function view(User $user, Configuration $configuration)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('detail-configuration');
    }

    public function create(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('create-configuration');
    }

    public function update(User $user, Configuration $configuration)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('update-configuration');
    }

    public function delete(User $user, Configuration $configuration)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('delete-configuration');
    }
}
