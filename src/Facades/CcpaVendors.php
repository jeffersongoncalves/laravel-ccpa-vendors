<?php

namespace JeffersonGoncalves\CcpaVendors\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JeffersonGoncalves\CcpaVendors\CcpaVendors
 */
class CcpaVendors extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-ccpa-vendors';
    }
}
