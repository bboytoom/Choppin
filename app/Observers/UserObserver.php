<?php

namespace App\Observers;

use App\User;
use App\Models\Shipping;

class UserObserver
{
    public function creating(User $user)
    {
        $user->name = e(strtolower($user->name));
        $user->mother_surname = e(strtolower($user->mother_surname));
        $user->father_surname = e(strtolower($user->father_surname));
        $user->email = e(strtolower($user->email));
        $user->password = \Hash::make($user->password);
        $user->status = 1;
    }

    public function updating(User $user)
    {
        if(isset($user->password)) {
            $user->password = \Hash::make($user->password);
        }

        $user->name = e(strtolower($user->name));
        $user->mother_surname = e(strtolower($user->mother_surname));
        $user->father_surname = e(strtolower($user->father_surname));
        $user->email = e(strtolower($user->email));
    }

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
