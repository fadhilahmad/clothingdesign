<?php

namespace App\Providers;

// Add as GateContract
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        // set the difference policies to different type of users
        $gate->define('isCustomer', function($user){
            return $user->user_type == 'customer';
        });

        $gate->define('isDesigner', function($user){
            return $user->user_type == 'designer';
        });

        $gate->define('isMoulder', function($user){
            return $user->user_type == 'moulder';
        });

        $gate->define('isTailor', function($user){
            return $user->user_type == 'tailor';
        });

        $gate->define('isHR', function($user){
            return $user->user_type == 'hr';
        });

        $gate->define('isAdmin', function($user){
            return $user->user_type == 'admin';
        });

        $gate->define('isManager', function($user){
            return $user->user_type == 'manager';
        });
        

    }
}
