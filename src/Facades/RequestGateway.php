<?php

namespace FlexCMS\BasicCMS\Facades;
use Illuminate\Support\Facades\Facade;

class RequestGateway extends Facade{
    protected static function getFacadeAccessor() { return 'requestgateway'; }
}