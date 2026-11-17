<?php

namespace JeffersonGoncalves\CcpaVendors;

use JeffersonGoncalves\CcpaVendors\Commands\VendorsCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CcpaVendorsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('ccpa-vendors')
            ->hasConfigFile()
            ->hasMigrations(['create_ccpa_vendors_table'])
            ->hasCommand(VendorsCommand::class);
    }
}
