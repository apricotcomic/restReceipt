<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class original_json extends Model
{
    //
    protected $table = 'original_json';

    protected $fillabe = [
        'id',
        'JSON_data',
        'receipt_id'
    ];

}
