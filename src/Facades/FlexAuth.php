<?php

namespace FlexCMS\BasicCMS\Facades;
use Illuminate\Support\Facades\Facade;

class FlexAuth extends Facade{
    protected static function getFacadeAccessor() { return 'flexauth'; }
}