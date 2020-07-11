<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class receipt extends Model
{
    //
    protected $table = 'receipt';

    protected $fillable = [
        'id',
        'purchase_date',
        'company_id',
        'branch_id',
        'terminal_id',
        'original_receipt_id',
        'total_tax',
        'total_fee',
        'original_JSON_id',
        'certify_date'
    ];

    protected $dates = [
        'purchase_date',
        'certify_date'
    ];
}
