<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('isAdmin', function ($user) {
            return $user->role === 'admin';
        });
        Gate::define('isDoctor', function ($user) {
            return $user->role === 'doctor';
        });
        Gate::define('isPharmacist', function ($user) {
            return $user->role === 'pharmacist';
        });
        Gate::define('isPatient', function ($user) {
            return $user->role === 'patient';
        });
        Gate::define('isDoctorOrPatientPharmacist', function ($user) {
            return $user->role === 'patient' || $user->role === 'doctor' || $user->role === 'pharmacist';
        });
    }
}
