<?php

namespace DavidUmoh\LaravelOpenID\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelOpenID extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravelopenid';
    }
}
