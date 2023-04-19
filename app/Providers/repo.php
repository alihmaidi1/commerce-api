<?php

namespace App\Providers;

use App\Services\repo\classes\admin;
use App\Services\repo\classes\banner;
use App\Services\repo\classes\brand;
use App\Services\repo\classes\cart;
use App\Services\repo\classes\category;
use App\Services\repo\classes\city;
use App\Services\repo\classes\copon;
use App\Services\repo\classes\country;
use App\Services\repo\classes\currency;
use App\Services\repo\classes\page;
use App\Services\repo\classes\product;
use App\Services\repo\classes\property;
use App\Services\repo\classes\review;
use App\Services\repo\classes\role;
use App\Services\repo\classes\slider;
use App\Services\repo\classes\tag;
use App\Services\repo\classes\temp;
use App\Services\repo\classes\user;
use App\Services\repo\classes\wishlist;
use App\Services\repo\interfaces\adminInterface;
use App\Services\repo\interfaces\bannerInterface;
use App\Services\repo\interfaces\brandInterface;
use App\Services\repo\interfaces\cartInterface;
use App\Services\repo\interfaces\categoryInterface;
use App\Services\repo\interfaces\cityInterface;
use App\Services\repo\interfaces\coponInterface;
use App\Services\repo\interfaces\countryInterface;
use App\Services\repo\interfaces\currencyInterface;
use App\Services\repo\interfaces\pageInterface;
use App\Services\repo\interfaces\productInterface;
use App\Services\repo\interfaces\propertyInterface;
use App\Services\repo\interfaces\reviewInterface;
use App\Services\repo\interfaces\roleInterface;
use App\Services\repo\interfaces\sliderInterface;
use App\Services\repo\interfaces\tagInterface;
use App\Services\repo\interfaces\tempInterface;
use App\Services\repo\interfaces\userInterface;
use App\Services\repo\interfaces\wishlistInterface;
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
        $this->app->bind(productInterface::class,product::class);
        $this->app->bind(tagInterface::class,tag::class);
        $this->app->bind(roleInterface::class,role::class);
        $this->app->bind(pageInterface::class,page::class);
        $this->app->bind(coponInterface::class,copon::class);
        $this->app->bind(userInterface::class,user::class);
        $this->app->bind(wishlistInterface::class,wishlist::class);
        $this->app->bind(cartInterface::class,cart::class);
        $this->app->bind(reviewInterface::class,review::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}