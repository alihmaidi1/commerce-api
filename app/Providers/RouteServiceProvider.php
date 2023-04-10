<?php

namespace App\Providers;

use App\Models\banner;
use App\Models\brand;
use App\Models\category;
use App\Models\copon;
use App\Models\country;
use App\Models\currency;
use App\Models\page;
use App\Models\product;
use App\Models\property;
use App\Models\role;
use App\Models\slider;
use App\Models\tag;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        Route::bind("currency",function($value){

            return Cache::rememberForever("currency:".$value,function() use($value){

                return currency::findOrFail($value);
            });

        });

        Route::bind("slider",function($value){

            return Cache::rememberForever("slider:".$value,function() use($value){

                return slider::findOrFail($value);
            });

        });


        Route::bind("banner",function($value){

            return Cache::rememberForever("banner:".$value,function() use($value){

                return banner::findOrFail($value);
            });

        });


        Route::bind("category",function($value){

            return Cache::rememberForever("category:".$value,function() use($value){

                return category::getCategory($value);
            });

        });

        Route::bind("country",function($value){

            return Cache::rememberForever("country:".$value,function() use($value){

                return country::with("citys:id,name,country_id,price")->findOrFail($value);
            });

        });

        Route::bind("property",function($value){

            return Cache::rememberForever("property:".$value,function() use($value){

                return property::with("products")->findOrFail($value);
            });

        });

        Route::bind("product",function($value){

            return Cache::rememberForever("product:".$value,function() use($value){

                return product::findOrFail($value);
            });

        });



        Route::bind("tag",function($value){

            return Cache::rememberForever("tag:".$value,function() use($value){

                return tag::findOrFail($value);
            });

        });

        Route::bind("brand",function($value){

            return Cache::rememberForever("brand:".$value,function() use($value){

                return brand::with("products")->findOrFail($value);
            });

        });



        Route::bind("role",function($value){

            return Cache::rememberForever("role:".$value,function() use($value){

                return role::with("admins")->findOrFail($value);
            });

        });


        Route::bind("page",function($value){

            return Cache::rememberForever("page:".$value,function() use($value){

                return page::findOrFail($value);
            });

        });



        Route::bind("copon",function($value){

            return Cache::rememberForever("copon:".$value,function() use($value){

                return copon::with("products")->findOrFail($value);
            });

        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
        RateLimiter::for("login",function(Request $request){

            return Limit::perMinute(3)->by($request->ip())->response(function(){

                return response()->json(["message"=>"Too Many request Please try after 1 minute"],429);

            });
        });

        RateLimiter::for("reset",function(Request $request){

            return Limit::perMinute(2)->by($request->ip())->response(function(){

                return response()->json(["message"=>"Too Many request Please try after 1 minute"],429);

            });
        });



    }
}