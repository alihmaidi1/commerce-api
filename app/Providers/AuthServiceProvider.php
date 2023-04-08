<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\admin;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        foreach(config("permissions") as $permission){

            Gate::define($permission,function( $admin)use($permission){


                if(in_array($permission,$admin->role->permissions)){

                    return true;

                }

                return false;
            });


        }

    }
}
