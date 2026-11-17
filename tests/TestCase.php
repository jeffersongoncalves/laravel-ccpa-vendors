<?php

namespace JeffersonGoncalves\CcpaVendors\Tests;

use JeffersonGoncalves\CcpaVendors\CcpaVendorsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            CcpaVendorsServiceProvider::class,
        ];
    }
}
