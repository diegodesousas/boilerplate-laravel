<?php

use Illuminate\Support\Facades\Config;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    protected $connectionsToTransact;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        Config::set('database.default', 'test');

        return $app;
    }

    protected function setUp()
    {
        $this->connectionsToTransact = ['test'];

        parent::setUp();
    }
}
