<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    //
    protected $table = 'company';

    protected $fillable = [
        'id',
        'name',
        'address',
        'zip',
        'tel',
        'fax',
        'email',
        'stamp_image',
        'receipt_image'
    ];
}
