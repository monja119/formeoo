<?php

namespace App\Providers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Cassandra\Exception\UnauthorizedException;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('admin', function () {
            // Vérifiez si la session entity existe
            if (session()->get('user')->role == 'admin') {
                return true; // Accès autorisé
            } else {
                // Lancer une exception d'autorisation (403) si l'accès est refusé
                throw new AuthorizationException('Accès interdit. Vous n\'avez pas l\'autorisation nécessaire pour accéder à cette ressource.');
            }
        });

        Gate::define('formateur', function () {
            // Vérifiez si la session entity existe
            if (session()->get('user')->role == 'formateur') {
                return true; // Accès autorisé
            } else {
                // Lancer une exception d'autorisation (403) si l'accès est refusé
                throw new AuthorizationException('Accès interdit. Vous n\'avez pas l\'autorisation nécessaire pour accéder à cette ressource.');
            }
        });

        Gate::define('apprenant', function () {
            // Vérifiez si la session entity existe
            if (session()->get('user')->role == 'apprenant') {
                return true; // Accès autorisé
            } else {
                // Lancer une exception d'autorisation (403) si l'accès est refusé
                throw new AuthorizationException('Accès interdit. Vous n\'avez pas l\'autorisation nécessaire pour accéder à cette ressource.');
            }
        });

    }
}
