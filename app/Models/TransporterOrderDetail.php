<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransporterOrderDetail extends Model
{
    protected $table = 'transporter_order_details';
    protected $fillable = [
        'transporter_order_id', 'gi_extension', 'gi_att', 'gi_desc', 'gi_tons', 'gi_abnormal', 'gi_reqd', 'gi_value', 'gi_currency', 'gi_rate', 'gi_terms', 'gi_instruction',
        'v_type_id', 'v_l', 'v_w', 'v_h', 'v_add_dimension', 'v_equipments',
        'v_container_number', 'v_driver_name', 'v_vessel_name', 'v_truck', 'v_trailer', 'v_trailer',
        'l_date', 'l_contact', 'l_telephone', 'o_date', 'o_contact', 'o_telephone',
        'load_addr_id', 'offload_addr_id', 'transporter_id', 'order_id'
    ];
}
