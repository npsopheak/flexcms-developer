<?php

namespace FlexCMS\BasicCMS\Facades;
use Illuminate\Support\Facades\Facade;

class CMS extends Facade{
    protected static function getFacadeAccessor() { return 'cms'; }
}