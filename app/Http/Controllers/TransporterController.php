<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use App\Models\Transporter;
use App\Models\TransporterOrder;
use App\Models\Order;
use App\Models\TransporterOrderDetail;
use App\Models\VehicleType;
use App\Models\LoadAddress;
use App\Models\OffLoadAddress;
use App\Models\Equipment;
use App\User;
use Auth;
use \PDF;
use Exception;
use DB;
use DateTime;

class TransporterController extends Controller
{
    public function getTransporterList()
    {
        $transporters = Transporter::select('*')->get();
        return view('transporter/list', ['transporters' => $transporters]);
    }

    public function getAllTransporters()
    {
        $transporters = Transporter::select('*')->get();
        return response()->json(['success' => $transporters]);
    }

    public function add(Request $request)
    {
        $order_id = $request->order_id;
        $add_transporter_id = $request->add_transporter_id;

        $result = 0;
        try{
            $existing_record = TransporterOrder::select('*')->where('order_id', $order_id)->where('transporter_id', $add_transporter_id)->first();
            if(empty($existing_record)){
                $new_transporter_order = TransporterOrder::create(['order_id' => $order_id, 'transporter_id' => $add_transporter_id]);
                if($new_transporter_order){
                    $result = $new_transporter_order->id;
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

    public function create(Request $request)
    {
        $account_no = $request->account_no;
        $transporter_name = $request->transporter_name;
        $transporter_address1 = $request->transporter_address1;

        $result = 0;
        try{
            $new_transporter = Transporter::create(
            [
                'account_no' => $account_no,
                'name' => $transporter_name,
                'address1' => $transporter_address1
            ]);

            if($new_transporter){
                $result = 1;
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

    public function edit(Request $request)
    {
        $edit_transporter_id = $request->edit_transporter_id;
        $edit_account_no = $request->edit_account_no;
        $edit_transporter_name = $request->edit_transporter_name;
        $edit_transporter_address1 = $request->edit_transporter_address1;

        $result = 0;
        try{
            Transporter::where('id', $edit_transporter_id)->update(
            [
                'account_no' => $edit_account_no,
                'name' => $edit_transporter_name,
                'address1' => $edit_transporter_address1
            ]);

            $result = 1;
        }
        catch(QueryException $e){
            $result = 0;
        }
        catch(Exception $e){
            $result = -1;
        }

        return response()->json(['success' => $result]);
    }

    public function delete(Request $request)
    {
        $order_id = $request->order_id;
        $delete_transporter_id = $request->delete_transporter_id;

        $result = 0;
        try{
            $delete_order_transporter = TransporterOrder::where('order_id', $order_id)->where('transporter_id', $delete_transporter_id);

            if($delete_order_transporter){
                $delete_order_transporter->delete();
                $result = 1;
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

    public function remove(Request $request)
    {
        $remove_transporter_id = $request->remove_transporter_id;

        $result = 0;
        try{
            $remove_order_transporters = TransporterOrder::where('transporter_id', $remove_transporter_id);

            if($remove_order_transporters){
                $remove_order_transporters->delete();
            }

            $remove_transporter = Transporter::where('id', $remove_transporter_id);
            if($remove_transporter){
                $remove_transporter->delete();
                $result = 1;
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

    public function change(Request $request)
    {
        $order_id = $request->order_id;
        $change_transporter_id = $request->change_transporter_id;

        $result = 0;
        try{
            TransporterOrder::where('order_id', $order_id)->update(
            [
                'transporter_id' => $change_transporter_id
            ]);

            $result = 1;
        }
        catch(QueryException $e){
            $result = 0;
        }
        catch(Exception $e){
            $result = -1;
        }

        return response()->json(['success' => $result]);
    }

    public function getLoadConfirmationList()
    {
        $confirmationList = DB::select('SELECT tos.order_id, ts.name,
        tods.gi_att, tods.gi_desc, tods.gi_tons, tods.gi_abnormal, tods.gi_instruction, tods.gi_reqd, tods.gi_value, tods.gi_currency, tods.gi_rate, tods.gi_terms, tods.v_l, tods.v_w, tods.v_h, tods.v_add_dimension,
        vts.name AS v_name, las.name AS l_name, oas.name AS o_name
        FROM transporter_order_details AS tods
        JOIN transporters_orders AS tos ON tods.transporter_order_id = tos.id
        JOIN transporters AS ts ON tos.transporter_id = ts.id
        JOIN vehicle_types AS vts ON tods.v_type_id = vts.id
        JOIN load_addresses AS las ON tods.load_addr_id = las.id
        JOIN off_load_addresses AS oas ON tods.offload_addr_id = oas.id
        ORDER BY tods.updated_at desc');

        return $confirmationList;
    }

    public function saveConfirmData(Request $request)
    {
        $transporter_order_id = $request->info[0];
        $gi_att = $request->info[1];
        $gi_desc = $request->info[2];
        $gi_tons = $request->info[3];
        $gi_abnormal = $request->info[4];
        $gi_instruction = $request->info[5];
        $gi_reqd = $request->info[6];
        $gi_value = $request->info[7];
        $gi_currency = $request->info[8];
        $gi_rate = $request->info[9];
        $gi_terms = $request->info[10];
        $v_type_id = $request->info[11];
        $v_l = $request->info[12];
        $v_w = $request->info[13];
        $v_h = $request->info[14];
        $v_add_dimension = $request->info[15];
        $load_addr_id = $request->info[16];
        $offload_addr_id = $request->info[17];
        $v_equipments = $request->info[18];
        $v_container_number = $request->info[19];
        $v_driver_name = $request->info[20];
        $v_vessel_name = $request->info[21];
        $v_truck = $request->info[22];
        $v_trailer = $request->info[23];
        $l_date = $request->info[24];
        $l_contact = $request->info[25];
        $l_telephone = $request->info[26];
        $o_date = $request->info[27];
        $o_contact = $request->info[28];
        $o_telephone = $request->info[29];
        $v_trailer2 = $request->info[30];
        $gi_extension = $request->info[31];
        $gi_extension_original = $request->info[32];
        $transporter_id = $request->info[33];
        $order_id = $request->info[34];

        $user_name = $request->info[35];
        $user_id = $request->info[36];

        $result = 0;
        try{
            $record = TransporterOrderDetail::select('*')->where('transporter_order_id', $transporter_order_id)
                        ->where('gi_extension', $gi_extension_original) ->first();

            if(!empty($record))
            {
                if($gi_extension == $gi_extension_original)
                {
                    TransporterOrderDetail::where('transporter_order_id', $transporter_order_id)
                    ->where('gi_extension', $gi_extension_original)->update(
                    [
                        'gi_att' => $gi_att,
                        'gi_desc' => $gi_desc,
                        'gi_tons' => $gi_tons,
                        'gi_abnormal' => $gi_abnormal,
                        'gi_reqd' => $gi_reqd,
                        'gi_value' => $gi_value,
                        'gi_rate' => $gi_rate,
                        'gi_currency' => $gi_currency,
                        'gi_terms' => $gi_terms,
                        'gi_instruction' => $gi_instruction,
                        'v_type_id' => $v_type_id,
                        'v_l' => $v_l,
                        'v_w' => $v_w,
                        'v_h' => $v_h,
                        'v_add_dimension' => $v_add_dimension,
                        'load_addr_id' => $load_addr_id,
                        'offload_addr_id' => $offload_addr_id,
                        'v_equipments' => $v_equipments,
                        'v_container_number' => $v_container_number,
                        'v_driver_name' => $v_driver_name,
                        'v_vessel_name' => $v_vessel_name,
                        'v_truck' => $v_truck,
                        'v_trailer' => $v_trailer,
                        'l_date' => new DateTime($l_date),
                        'l_contact' => $l_contact,
                        'l_telephone' => $l_telephone,
                        'o_date' => new DateTime($o_date),
                        'o_contact' => $o_contact,
                        'o_telephone' => $o_telephone,
                        'v_trailer2' => $v_trailer2,
                        'gi_extension' => $gi_extension_original,
                        'transporter_id' => $transporter_id,
                        'order_id' => $order_id
                    ]);
                }
                else
                {
                    $record2 = TransporterOrderDetail::select('*')->where('transporter_order_id', $transporter_order_id)
                        ->where('gi_extension', $gi_extension) ->first();

                    if(empty($record2))
                    {
                        TransporterOrderDetail::create(
                        [
                            'transporter_order_id' => $transporter_order_id,
                            'gi_att' => $gi_att,
                            'gi_desc' => $gi_desc,
                            'gi_tons' => $gi_tons,
                            'gi_abnormal' => $gi_abnormal,
                            'gi_reqd' => $gi_reqd,
                            'gi_value' => $gi_value,
                            'gi_currency' => $gi_currency,
                            'gi_rate' => $gi_rate,
                            'gi_terms' => $gi_terms,
                            'gi_instruction' => $gi_instruction,
                            'v_type_id' => $v_type_id,
                            'v_l' => $v_l,
                            'v_w' => $v_w,
                            'v_h' => $v_h,
                            'v_add_dimension' => $v_add_dimension,
                            'load_addr_id' => $load_addr_id,
                            'offload_addr_id' => $offload_addr_id,
                            'v_equipments' => $v_equipments,
                            'v_container_number' => $v_container_number,
                            'v_driver_name' => $v_driver_name,
                            'v_vessel_name' => $v_vessel_name,
                            'v_truck' => $v_truck,
                            'v_trailer' => $v_trailer,
                            'l_date' => new DateTime($l_date),
                            'l_contact' => $l_contact,
                            'l_telephone' => $l_telephone,
                            'o_date' => new DateTime($o_date),
                            'o_contact' => $o_contact,
                            'o_telephone' => $o_telephone,
                            'v_trailer2' => $v_trailer2,
                            'gi_extension' => $gi_extension,
                            'transporter_id' => $transporter_id,
                            'order_id' => $order_id
                        ]);
                    }
                    else
                    {
                        TransporterOrderDetail::where('transporter_order_id', $transporter_order_id)
                        ->where('gi_extension', $gi_extension)->update(
                        [
                            'gi_att' => $gi_att,
                            'gi_desc' => $gi_desc,
                            'gi_tons' => $gi_tons,
                            'gi_abnormal' => $gi_abnormal,
                            'gi_reqd' => $gi_reqd,
                            'gi_value' => $gi_value,
                            'gi_rate' => $gi_rate,
                            'gi_currency' => $gi_currency,
                            'gi_terms' => $gi_terms,
                            'gi_instruction' => $gi_instruction,
                            'v_type_id' => $v_type_id,
                            'v_l' => $v_l,
                            'v_w' => $v_w,
                            'v_h' => $v_h,
                            'v_add_dimension' => $v_add_dimension,
                            'load_addr_id' => $load_addr_id,
                            'offload_addr_id' => $offload_addr_id,
                            'v_equipments' => $v_equipments,
                            'v_container_number' => $v_container_number,
                            'v_driver_name' => $v_driver_name,
                            'v_vessel_name' => $v_vessel_name,
                            'v_truck' => $v_truck,
                            'v_trailer' => $v_trailer,
                            'l_date' => new DateTime($l_date),
                            'l_contact' => $l_contact,
                            'l_telephone' => $l_telephone,
                            'o_date' => new DateTime($o_date),
                            'o_contact' => $o_contact,
                            'o_telephone' => $o_telephone,
                            'v_trailer2' => $v_trailer2,
                            'gi_extension' => $gi_extension,
                            'transporter_id' => $transporter_id,
                            'order_id' => $order_id
                        ]);
                    }
                }
            }
            else
            {
                TransporterOrderDetail::create(
                [
                    'transporter_order_id' => $transporter_order_id,
                    'gi_att' => $gi_att,
                    'gi_desc' => $gi_desc,
                    'gi_tons' => $gi_tons,
                    'gi_abnormal' => $gi_abnormal,
                    'gi_reqd' => $gi_reqd,
                    'gi_value' => $gi_value,
                    'gi_currency' => $gi_currency,
                    'gi_rate' => $gi_rate,
                    'gi_terms' => $gi_terms,
                    'gi_instruction' => $gi_instruction,
                    'v_type_id' => $v_type_id,
                    'v_l' => $v_l,
                    'v_w' => $v_w,
                    'v_h' => $v_h,
                    'v_add_dimension' => $v_add_dimension,
                    'load_addr_id' => $load_addr_id,
                    'offload_addr_id' => $offload_addr_id,
                    'v_equipments' => $v_equipments,
                    'v_container_number' => $v_container_number,
                    'v_driver_name' => $v_driver_name,
                    'v_vessel_name' => $v_vessel_name,
                    'v_truck' => $v_truck,
                    'v_trailer' => $v_trailer,
                    'l_date' => new DateTime($l_date),
                    'l_contact' => $l_contact,
                    'l_telephone' => $l_telephone,
                    'o_date' => new DateTime($o_date),
                    'o_contact' => $o_contact,
                    'o_telephone' => $o_telephone,
                    'v_trailer2' => $v_trailer2,
                    'gi_extension' => $gi_extension,
                    'transporter_id' => $transporter_id,
                    'order_id' => $order_id
                ]);
            }

            User::where('id', $user_id)->update(
            [
                'name' => $user_name
            ]);

            $result = $transporter_order_id;
        }
        catch(QueryException $e){
            $result = 0;
        }
        catch(Exception $e){
            $result = -1;
        }

        return response()->json(['success' => $result]);
    }

    public function saveExtension(Request $request)
    {
        $request->session()->put('extension', $request->all());
        return response()->json(['success' => 1]);
    }

    public function getOrderTransporterDetails($id)
    {
        $extension = session('extension');

        $confirmationList = $this->getLoadConfirmationList();

        $record = TransporterOrder::select('*')->where('id', $id)->first();
        $order = Order::select('*')->where('id', $record->order_id)->first();
        $transporter = Transporter::select('*')->where('id', $record->transporter_id)->first();
        $transporter_order_detail = TransporterOrderDetail::select('*')->where('transporter_order_id', $record->id)->where('gi_extension', $extension['tex'])->first();

        $loadAddrs = LoadAddress::select('*')->get();
        $offLoadAddrs = OffLoadAddress::select('*')->get();
        $equipments = Equipment::select('*')->get();

        $select_equipments = null;
        if($transporter_order_detail && $transporter_order_detail->v_equipments){
            $select_equipments = explode(',', $transporter_order_detail->v_equipments);
        }

        $select_loadAddr = null;
        if($transporter_order_detail && $transporter_order_detail->load_addr_id){
            $select_loadAddr = $loadAddrs->where('id', $transporter_order_detail->load_addr_id)->first();
        }

        $select_offloadAddr = null;
        if($transporter_order_detail && $transporter_order_detail->offload_addr_id){
            $select_offloadAddr = $offLoadAddrs->where('id', $transporter_order_detail->offload_addr_id)->first();
        }

        return view('transporter/detail',
            ['confirmationList' => $confirmationList, 'id' => $id, 'order' => $order, 'transporter' => $transporter,
            'transporter_order_detail' => $transporter_order_detail, 'loadAddrs' => $loadAddrs, 'equipments' => $equipments,
            'offLoadAddrs' => $offLoadAddrs, 'select_loadAddr' => $select_loadAddr, 'select_offloadAddr' => $select_offloadAddr,
            'select_equipments' => $select_equipments]);
    }

    public function getExitingTransporterDetails(Request $request)
    {

        $record = $request->all();

        $result = 0;
        try{
            $transporter_order_detail = TransporterOrderDetail::where('transporter_order_id', $record['id'])->where('gi_extension', $record['ext'])->first();
            if($transporter_order_detail){
                $result = $transporter_order_detail->transporter_order_id;
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

    public function previewConfirmationData(Request $request)
    {
        $request->session()->put('preview', $request->all());
        return response()->json(['success' => 1]);
    }

    public function previewPdf()
    {
        $transporter_order_detail = session('preview');
        $transporter_order_id = $transporter_order_detail[0];
        $v_type_id = $transporter_order_detail[11];
        $load_addr_id = $transporter_order_detail[16];
        $offload_addr_id = $transporter_order_detail[17];
        $transporter_id = $transporter_order_detail[33];

        $record = TransporterOrder::select('*')->where('id', $transporter_order_id)->first();
        $order = Order::select('*')->where('id', $record->order_id)->first();
        $transporter = Transporter::select('*')->where('id', $transporter_id)->first();
        $user = $transporter_order_detail[35]; //Auth::user()->name;
        $vehicle_type = VehicleType::select('*')->where('id', $v_type_id)->first();
        $loadAddr = LoadAddress::select('*')->where('id', $load_addr_id)->first();
        $offloadAddr = OffLoadAddress::select('*')->where('id', $offload_addr_id)->first();

        // $loadAddr->name = $transporter_order_detail[37];
        // $loadAddr->address1 = $transporter_order_detail[38];
        // $loadAddr->address2 = $transporter_order_detail[39];
        // $loadAddr->address3 = $transporter_order_detail[40];
        // $loadAddr->city = $transporter_order_detail[41];
        // $loadAddr->province1 = $transporter_order_detail[42];
        // $loadAddr->province2 = $transporter_order_detail[43];

        $equipment_names = '';
        if($transporter_order_detail && $transporter_order_detail[18])
        {
            $items = explode(',', $transporter_order_detail[18]);

            foreach($items as $item)
            {
                $equipment = Equipment::select('*')->where('id', $item)->first();
                $equipment_names .= $equipment->name . ', ';
            }

            $equipment_names = rtrim($equipment_names, ", ");
        }

        session()->forget('preview');

        $customPaper = array(0,0,920,1440);
        $pdf = PDF::loadview('pdf/preview', compact('order', 'transporter', 'user', 'transporter_order_detail', 'vehicle_type', 'loadAddr', 'offloadAddr', 'equipment_names'))
        ->setPaper($customPaper, 'portrait');
        return $pdf->stream();
    }

    public function downloadPdf($id, $ext)
    {
        $record = TransporterOrder::select('*')->where('id', $id)->first();
        $order = Order::select('*')->where('id', $record->order_id)->first();
        $user = Auth::user();
        $transporter_order_detail = TransporterOrderDetail::select('*')->where('transporter_order_id', $id)->where('gi_extension', $ext)->first();
        $transporter = Transporter::select('*')->where('id', $transporter_order_detail->transporter_id)->first();
        $vehicle_type = VehicleType::select('*')->where('id', $transporter_order_detail->v_type_id)->first();
        $loadAddr = LoadAddress::select('*')->where('id', $transporter_order_detail->load_addr_id)->first();
        $offloadAddr = OffLoadAddress::select('*')->where('id', $transporter_order_detail->offload_addr_id)->first();


        $equipment_names = '';
        if($transporter_order_detail && $transporter_order_detail->v_equipments)
        {
            $items = explode(',', $transporter_order_detail->v_equipments);

            foreach($items as $item)
            {
                $equipment = Equipment::select('*')->where('id', $item)->first();
                $equipment_names .= $equipment->name . ', ';
            }

            $equipment_names = rtrim($equipment_names, ", ");
        }

        $customPaper = array(0,0,920,1440);
        $pdf = PDF::loadview('pdf/order', compact('order', 'transporter', 'user', 'transporter_order_detail', 'vehicle_type', 'loadAddr', 'offloadAddr', 'equipment_names'))
        ->setPaper($customPaper, 'portrait');
        return $pdf->download('UC'.$order->id.'.pdf');
    }

    public function changeTransporter(Request $request)
    {
        $transporter_order_id = $request->transporter_order_id;
        $transporter_id = $request->transporter_id;
        $extension = $request->extension;

        $result = 0;
        try{
            TransporterOrderDetail::where('transporter_order_id', $transporter_order_id)->where('gi_extension', $extension)->update(
            [
                'transporter_id' => $transporter_id
            ]);

            $result = 1;
        }
        catch(QueryException $e){
            $result = 0;
        }
        catch(Exception $e){
            $result = -1;
        }

        return response()->json($result);
    }
}
