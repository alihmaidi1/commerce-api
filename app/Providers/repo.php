<?php

namespace App\Providers;

use App\Services\repo\classes\admin;
use App\Services\repo\classes\banner;
use App\Services\repo\classes\currency;
use App\Services\repo\classes\slider;
use App\Services\repo\classes\temp;
use App\Services\repo\interfaces\adminInterface;
use App\Services\repo\interfaces\bannerInterface;
use App\Services\repo\interfaces\currencyInterface;
use App\Services\repo\interfaces\sliderInterface;
use App\Services\repo\interfaces\tempInterface;
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
        $this->app->bind(tempInterface::class,temp::class);
        $this->app->bind(sliderInterface::class,slider::class);
        $this->app->bind(bannerInterface::class,banner::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
