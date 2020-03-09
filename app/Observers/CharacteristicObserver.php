<?php

namespace App\Observers;

use App\Models\Characteristic;

class CharacteristicObserver
{
    public function creating(Characteristic $characteristic)
    {
        $characteristic->name = e(strtolower($characteristic->name));
        $characteristic->description = e(strtolower($characteristic->description));
        $characteristic->status = 1;
    }

    public function updating(Characteristic $characteristic)
    {
        $characteristic->name = e(strtolower($characteristic->name));
        $characteristic->description = e(strtolower($characteristic->description));
        $characteristic->status = $characteristic->status;
    }
}
