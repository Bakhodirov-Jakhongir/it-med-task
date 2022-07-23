<?php

namespace App\Providers;

use App\Repositories\DoctorRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\Interfaces\DoctorRepositoryInterface;
use App\Repositories\Interfaces\InstitutionRepositoryInterface;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Repositories\PatientRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
        $this->app->bind(InstitutionRepositoryInterface::class, InstitutionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
