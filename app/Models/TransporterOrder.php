<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransporterOrder extends Model
{
    protected $table = 'transporters_orders';
    protected $fillable = [
        'order_id', 'transporter_id'
    ];
}
