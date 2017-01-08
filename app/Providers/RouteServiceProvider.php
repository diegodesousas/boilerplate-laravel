<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {

            $this->includeFiles(base_path('routes/api'));
        });
    }

    /**
     * Faz o include de todos os arquivos no caminho informado
     *
     * @param string $path
     */
    private function includeFiles(string $path)
    {
        $adapter = new Local($path);

        $filesystem = new Filesystem($adapter);

        foreach ($filesystem->listContents() as $file) {

            if ($file['type'] === 'dir') {
                $this->includeFiles("{$path}/{$file['path']}");
            } else {
                require "{$path}/{$file['path']}";
            }
        }
    }
}
