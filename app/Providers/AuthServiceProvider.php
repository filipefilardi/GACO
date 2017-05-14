<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Util\Dao\PermissionDao;

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
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('execute', function ($user, $nm_perm) {

            $res = PermissionDao::getPermissionByCat($user->id_cat,$nm_perm);

            if ($res->isEmpty()) {
                return 0;
            }else{
                
                return 1;
            }
        });
    }
}
