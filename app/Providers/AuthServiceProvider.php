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


        Gate::define('update-address', function ($user, $address) {

            if ($user->id != $address->user_id) {
                return false;
            } else {
                return true;
            }

        });

        Gate::define('customer', function ($user) {
            if ($user->role == 'customer') {
                return true;
            }

            return false;

        });

        Gate::define('isAdmin', function ($user) {
            if ($user->role == 'admin') {
                return true;
            }

            return false;

        });

        Gate::define('seller', function ($user) {
            if ($user->role == 'seller') {
                return true;
            }

            return false;
        });


    }
}
