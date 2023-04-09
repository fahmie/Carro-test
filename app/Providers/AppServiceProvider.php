<?php

namespace App\Providers;

use App\Services\EmployeeManagement\Applicant;
use App\Services\EmployeeManagement\Employee;
use App\Services\EmployeeManagement\Staff;
use Illuminate\Support\ServiceProvider;
use App\Services\InternetServiceProvider\InternetServiceProviderInterface;
use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // bind InternetServiceProviderInterface to default implementation Mpt
        $this->app->bind(InternetServiceProviderInterface::class, Mpt::class);

        // bind Mpt and Ooredoo to themselves
        $this->app->bind(Mpt::class, Mpt::class);
        $this->app->bind(Ooredoo::class, Ooredoo::class);


        $this->app->bind(Employee::class, Applicant::class);
        $this->app->bind(Employee::class, Staff::class);

        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
