<?php
namespace Theluguiant\Payu\Facades;

use Illuminate\Support\Facades\Facade;

class Payu extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'Payu';
    }
}