<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientOrder extends Model
{
    protected $table = 'clients_orders';
    protected $fillable = [
        'order_id', 'client_id'
    ];
}
