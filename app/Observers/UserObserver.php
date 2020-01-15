<?php

namespace App\Observers;

use App\User;
use App\Models\Shipping;

class UserObserver
{
    /**
     * Handle the user "creating" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->name = e(strtolower($user->name));
        $user->mother_surname = e(strtolower($user->mother_surname));
        $user->father_surname = e(strtolower($user->father_surname));
        $user->email = e(strtolower($user->email));
        $user->password = \Hash::make('@User2907');
    }

    /**
     * Handle the user "updating" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updating(User $user)
    {
        $user->name = e(strtolower($user->name));
        $user->mother_surname = e(strtolower($user->mother_surname));
        $user->father_surname = e(strtolower($user->father_surname));
        $user->email = e(strtolower($user->email));
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        if($user->status == 0)
        {
            Shipping::where('user_id', $user->id)->update(['status' => 0]);
        }
        else
        {
            Shipping::where('user_id', $user->id)->update(['status' => 1]);
        }
    }
}
