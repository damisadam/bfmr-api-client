<?php

namespace damisadam\BfmrApiClient\Facades;

use Illuminate\Support\Facades\Facade;

class BfmrApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bfmr-api';
    }
}