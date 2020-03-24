<?php

namespace App\Policies;

use App\Models\Metas;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MetasPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('read-meta');
    }

    public function view(User $user, Metas $metas)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('detail-meta');
    }

    public function create(User $user)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('create-meta');
    }

    public function update(User $user, Metas $metas)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('update-meta');
    }

    public function delete(User $user, Metas $metas)
    {
        if ($user->type == 'administrador') {
            return true;
        }

        return $user->Access('delete-meta');
    }
}
