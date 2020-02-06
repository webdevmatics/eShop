<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Address' => 'App\Policies\AddressPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Gate::define('update-address', function($user, $address){

            if($user->id != $address->user_id) {
                return false;
            }else{
                return true;
            }

        });

        Gate::define('isAdmin', function($user){
            if($user->id != 1) {
                return false;
            }

            return true;

        });




    }
}
