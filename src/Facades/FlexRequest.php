<?php

namespace FlexCMS\BasicCMS\Facades;
use Illuminate\Support\Facades\Facade;

class FlexRequest extends Facade{
    protected static function getFacadeAccessor() { return 'flexrequest'; }
}