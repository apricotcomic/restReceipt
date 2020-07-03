<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ReceiptPrintService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ReceiptPrintService';
    }
}
