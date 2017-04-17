<?php

namespace FlexCMS\BasicCMS\Facades;
use Illuminate\Support\Facades\Facade;

class AuthGateway extends Facade{
    protected static function getFacadeAccessor() { return 'authgateway'; }
}