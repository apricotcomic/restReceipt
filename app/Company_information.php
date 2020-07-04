<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_information extends Model
{
    //
    protected $table = 'company_information';

    protected $connection = 'mysql_receiptDesign';

    protected $fillable = [
        'id',
        'name',
        'address',
        'zip',
        'tel',
        'fax',
        'email',
        'stamp_image',
        'receipt_image',
        'company_id'
    ];
}
