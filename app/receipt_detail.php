<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class receipt_detail extends Model
{
    //
    protected $table = 'receipt_detail';
    protected $fillable = [
        'id',
        'receipt_id',
        'line_no',
        'item_name',
        'unit_price',
        'quantity',
        'tax',
        'fee',
        'item_1',
        'item_2',
        'item_3',
        'item_4',
        'item_5'
    ];
}
