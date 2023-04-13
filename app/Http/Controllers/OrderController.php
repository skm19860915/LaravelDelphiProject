<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\ClientOrder;
use App\Models\TransporterOrder;
use App\Models\TransporterOrderDetail;
use DB;
use DateTime;

class OrderController extends Controller
{
    public function index()
    {
        return view('order/index');
    }

    public function getAllOrderDetails()
    {
        // $orderDetails = DB::select('SELECT data1.*, tdata.* FROM (SELECT o.id AS oid, o.cancelled, o.date_created, cdata.* FROM orders AS o
        // LEFT JOIN (SELECT co.order_id AS coid, co.client_id, c.account_no AS cno, c.name AS cname FROM clients_orders AS co JOIN clients AS c ON c.id = co.client_id) AS cdata ON o.id = cdata.coid) AS data1
        // LEFT JOIN (SELECT ot.order_id AS toid, ot.transporter_id, t.account_no AS tno, t.name AS tname, dt.gi_desc AS commodity, dt.gi_tons AS weight, dt.transporter_order_id AS tod, dt.gi_extension AS tex FROM transporters_orders AS ot JOIN transporters AS t ON t.id = ot.transporter_id
        // LEFT JOIN transporter_order_details AS dt ON ot.id = dt.transporter_order_id) AS tdata ON data1.oid = tdata.toid
        // ORDER BY data1.oid DESC');

        $orderDetails = DB::select('SELECT data1.*, tdata.* FROM (SELECT o.id AS oid, o.cancelled, o.date_created, cdata.* FROM orders AS o
        LEFT JOIN (SELECT co.order_id AS coid, co.client_id, c.account_no AS cno, c.name AS cname FROM clients_orders AS co JOIN clients AS c ON c.id = co.client_id) AS cdata ON o.id = cdata.coid) AS data1
        LEFT JOIN (SELECT ot.order_id AS toid, ot.transporter_id, t.account_no AS tno, t.name AS tname, ot.gi_desc AS commodity, ot.gi_tons AS weight, ot.transporter_order_id AS tod, ot.gi_extension AS tex
        FROM transporter_order_details AS ot JOIN transporters AS t ON t.id = ot.transporter_id) AS tdata ON data1.oid = tdata.toid
        ORDER BY data1.oid DESC');

        return view('order/all', ['orderDetails' => $orderDetails]);
    }

    public function getOrder($id)
    {
        $order = Order::where('id', $id)->first();
        $clients = ClientOrder::where('order_id', $id)->join('clients', 'clients.id', '=', 'clients_orders.client_id')->get();
        $transporters = TransporterOrder::where('order_id', $id)->join('transporters', 'transporters.id', '=', 'transporters_orders.transporter_id')->get();
        return view('order/detail', ['order' => $order, 'clients' => $clients, 'transporters' => $transporters]);
    }

    public function save(Request $request)
    {
        $remarks = $request->remarks;
        $created_date = $request->created_date;
        $select_client_id = $request->select_client_id;
        $select_transporter_id = $request->select_transporter_id;

        $result = 0;
        try{
            $new_order = Order::create(['branch' => 'J', 'date_created' =>  new DateTime($created_date), 'remarks' => $remarks]);
            if($new_order)
            {
                $new_client_order = ClientOrder::create(['order_id' => $new_order->id, 'client_id' => $select_client_id]);
                if($new_client_order)
                {
                    $new_transporter_order = TransporterOrder::create(['order_id' => $new_order->id, 'transporter_id' => $select_transporter_id]);
                    if($new_transporter_order)
                    {
                        $new_transporter_order_detail = TransporterOrderDetail::create(['transporter_order_id' => $new_transporter_order->id, 'v_type_id' => 1,
                        'order_id' => $new_order->id, 'transporter_id' => $select_transporter_id]);
                        if($new_transporter_order_detail)
                        {
                            $result = 1;
                        }
                    }
                }
            }
        }
        catch(QueryException $e){
            $result = 0;
        }
        catch(Exception $e){
            $result = -1;
        }

        return response()->json(['success' => $result]);
    }

    public function getTransporterOrder(Request $request)
    {
        $result = 0;
        $order_id = $request->order_id;
        $transporter_id = $request->transporter_id;
        $existing_record = TransporterOrder::select('*')->where('order_id', $order_id)->where('transporter_id', $transporter_id)->first();

        if(!empty($existing_record)){
            $result = $existing_record->id;
        }

        return response()->json(['success' => $result]);
    }
}
