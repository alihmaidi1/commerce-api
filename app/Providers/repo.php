<?php

namespace App\Providers;

use App\Services\repo\classes\admin;
use App\Services\repo\classes\banner;
use App\Services\repo\classes\brand;
use App\Services\repo\classes\category;
use App\Services\repo\classes\city;
use App\Services\repo\classes\country;
use App\Services\repo\classes\currency;
use App\Services\repo\classes\property;
use App\Services\repo\classes\slider;
use App\Services\repo\classes\temp;
use App\Services\repo\interfaces\adminInterface;
use App\Services\repo\interfaces\bannerInterface;
use App\Services\repo\interfaces\brandInterface;
use App\Services\repo\interfaces\categoryInterface;
use App\Services\repo\interfaces\cityInterface;
use App\Services\repo\interfaces\countryInterface;
use App\Services\repo\interfaces\currencyInterface;
use App\Services\repo\interfaces\propertyInterface;
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
        $this->app->bind(categoryInterface::class,category::class);
        $this->app->bind(brandInterface::class,brand::class);
        $this->app->bind(countryInterface::class,country::class);
        $this->app->bind(cityInterface::class,city::class);
        $this->app->bind(propertyInterface::class,property::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
