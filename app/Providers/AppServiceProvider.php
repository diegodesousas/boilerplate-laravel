<?php

namespace App\Providers;

use App\Actions\ManagerActions;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ManagerActions::class, function() {

            return new ManagerActions($this->app);
        });
    }
}
