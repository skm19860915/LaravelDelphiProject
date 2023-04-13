<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transporter extends Model
{
    protected $table = 'transporters';
    protected $fillable = [
        'account_no', 'name', 'address1'
    ];
}
