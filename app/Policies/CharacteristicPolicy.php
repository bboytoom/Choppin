<?php

namespace App\Policies;

use App\Models\Characteristic;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CharacteristicPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('read-characteristic');
    }

    public function view(User $user, Characteristic $characteristic)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('detail-characteristic');
    }

    public function create(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('create-characteristic');
    }

    public function update(User $user, Characteristic $characteristic)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('update-characteristic');
    }

    public function delete(User $user, Characteristic $characteristic)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('delete-characteristic');
    }
}
