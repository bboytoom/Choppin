<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PerfilPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->Access('read-perfil');
    }

    public function view(User $user, User $model)
    {
        return $user->Access('detail-perfil');
    }

    public function create(User $user)
    {
        return $user->Access('create-perfil');
    }

    public function update(User $user, User $model)
    {
        return $user->Access('update-perfil');
    }

    public function delete(User $user, User $model)
    {
        return $user->Access('delete-perfil');
    }
}
