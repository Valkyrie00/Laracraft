<?php
namespace Valkyrie\Laracraft\Facades;

use Illuminate\Support\Facades\Facade as LFacade;

class Laracraft extends LFacade
{
    /**
     * Name of the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laracraft';
    }
}
