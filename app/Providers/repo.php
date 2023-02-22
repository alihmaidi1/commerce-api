<?php

namespace App\Providers;

use App\Services\repo\classes\admin;
use App\Services\repo\interfaces\adminInterface;
use Illuminate\Support\ServiceProvider;

class repo extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        $this->app->bind(adminInterface::class,admin::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}