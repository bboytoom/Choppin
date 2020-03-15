<?php

namespace App\Observers;

use App\User;
use App\Models\Shipping;

class UserObserver
{
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
