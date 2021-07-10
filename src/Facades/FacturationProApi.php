<?php

namespace AtomeDev\FacturationProApi\Facades;

use Illuminate\Support\Facades\Facade;

class FacturationProApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'facturation-pro-api';
    }
}
