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
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //Passport::hashClientSecrets();
        // Passport::routes();  //Since version 11 passport's routes have been moved to a dedicated route file. You can remove the Passport::routes() call from your application's service provider. https://stackoverflow.com/questions/74134310/call-to-undefined-method-laravel-passport-passportroutes

        $this->registerPolicies();
    }
}
