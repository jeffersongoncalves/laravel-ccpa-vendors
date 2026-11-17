<?php

namespace JeffersonGoncalves\CcpaVendors;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CcpaVendorsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-ccpa-vendors')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations();
    }
}
