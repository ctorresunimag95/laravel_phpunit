<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class BaseTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    protected $manager;

    protected static $wasSetup = false;

    public static function setUpBeforeClass(): void
    {
        if (!static::$wasSetup) {
            //Execute before class setup
            static::$wasSetup = true;
        }
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->Provission();
    }

    abstract protected function Provission();
}
