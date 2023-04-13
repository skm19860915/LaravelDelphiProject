<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Order;
use DB;

class XeRequest implements FromCollection,WithHeadings
{
    private $ids;

    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    public function headings(): array
    {
        return [
            'Manifest number',
            'File Ref number',
            'Bill of entry number',
            'Line number',
            'Ex Container',
            'Weight',
            'Number of packages',
            'Border Post',
            'Final Destination',
            'Remover'
        ];
    }

    public function collection()
    {
        $excel_arr = [];

        $orders = DB::select('SELECT os.id, os.date_created, os.remarks, os.client_id, os.account_no AS cno, os.name AS cname,
        tt.transporter_id, tt.account_no AS tno, tt.name AS tname, tt.gi_tons AS weight, tt.province1 AS province FROM
        (SELECT o.id, o.date_created, o.cancelled, o.remarks, co.order_id, co.client_id, c.account_no, c.name
        FROM orders AS o JOIN clients_orders AS co ON o.id = co.order_id JOIN clients AS c ON c.id = co.client_id) AS os
        LEFT JOIN (SELECT ot.order_id, ot.transporter_id, t.account_no, t.name, td.gi_tons, ol.province1 FROM transporters_orders AS ot
        JOIN transporters AS t ON ot.transporter_id = t.id JOIN transporter_order_details AS td ON ot.id = td.transporter_order_id
        JOIN off_load_addresses AS ol ON td.offload_addr_id = ol.id) AS tt
        ON os.id = tt.order_id WHERE os.cancelled = 0 AND tt.gi_tons IS NOT NULL ORDER BY os.id desc');

        foreach($orders as $order){
            foreach($this->ids as $id){
                if($order->id == $id){
                    $data['manifest_number'] = "UC".$order->id;
                    $data['file_ref_number'] = '';
                    $data['bill_of_entry_number'] = '';
                    $data['line_number'] = '';
                    $data['ex_container'] = '';
                    $data['weight'] = $order->weight."kgs";
                    $data['number_of_packages'] = '';
                    $data['border_post'] = '';
                    $data['final_destination'] = $order->province;
                    $data['remover'] = '';
                    $excel_arr[] = $data;
                }
            }
        }

        return collect($excel_arr);
    }
}
