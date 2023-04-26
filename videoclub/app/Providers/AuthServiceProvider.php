<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

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
        //Para el momento del despliegue - ver documentación oficial passport:keys
        //Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');

        //Para que los secrets estén hasheados en la base de datos. Daba conflictos al crear usuario, Postman devolvía error
        //https://stackoverflow.com/questions/39572957/laravel-passport-password-grant-client-authentication-failed
        //Passport::hashClientSecrets();

        //Passport::routes();
        //$this->registerPolicies();
    }
}
