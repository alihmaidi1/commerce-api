<?php

namespace App\Providers;

use App\Services\repo\classes\admin;
use App\Services\repo\classes\currency;
use App\Services\repo\interfaces\adminInterface;
use App\Services\repo\interfaces\currencyInterface;
use Illuminate\Support\ServiceProvider;

class repo extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        $this->app->bind(adminInterface::class,admin::class);
        $this->app->bind(currencyInterface::class,currency::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}