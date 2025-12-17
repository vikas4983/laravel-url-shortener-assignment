<?php

namespace App\Providers;

use App\Models\Company;
use App\Policies\CompanyPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Livewire\WithPagination;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
