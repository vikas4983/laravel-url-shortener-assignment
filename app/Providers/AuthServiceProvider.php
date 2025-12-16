<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Invitation;
use App\Policies\CompanyPolicy;
use App\Policies\InvitationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Company::class => CompanyPolicy::class,
        Invitation::class => InvitationPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('invite-create-view', function ($user) {
            return $user->hasAnyRole(['SuperAdmin', 'Admin']);
        });
    }
}
