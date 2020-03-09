<?php

namespace App\Observers;

use App\Configuration;

class ConfigurationObserver
{
    public function updating(Configuration $configuration)
    {
        $configuration->domain = e(strtolower($configuration->domain));
        $configuration->name = e(strtolower($configuration->name));
        $configuration->business_name = e(strtolower($configuration->business_name));
        $configuration->slogan = e(strtolower($configuration->slogan));
        $configuration->email = e(strtolower($configuration->email));
        $configuration->phone = e(strtolower($configuration->phone));
        $configuration->status = 1;
    }
}
