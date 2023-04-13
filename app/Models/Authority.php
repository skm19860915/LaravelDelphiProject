<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authority extends Model
{
    protected $table = 'authorities';
    protected $fillable = [
        'name'
    ];
}
