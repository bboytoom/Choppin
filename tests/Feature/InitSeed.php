<?php

namespace Tests\Feature;

class InitSeed
{
    private static $instance = null;
    private $seed;

    private function __construct()
    {
        $this->seed = new SeedTest();
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new InitSeed();
        }
        
        return self::$instance;
    }

    public function getSeed()
    {
        return $this->seed;
    }
}
