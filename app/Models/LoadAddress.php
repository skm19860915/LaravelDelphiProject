<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoadAddress extends Model
{
    protected $table = 'load_addresses';
    protected $fillable = [
        'name', 'address1', 'address2', 'address3', 'city', 'province1', 'province2'
    ];
}
