<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\TransporterOrderDetail;

class EquipmentController extends Controller
{
    public function get()
    {
        $all = Equipment::select('*')->get();
        return response()->json($all);
    }

    public function create(Request $request)
    {
        $equipment_name = $request->equipment_name;

        $result = null;
        try{
            $new_equipment= Equipment::create(
            [
                'name' => $equipment_name
            ]);

            if($new_equipment){
                $result = $new_equipment;
            }
        }
        catch(QueryException $e){
            $result = null;
        }
        catch(Exception $e){
            $result = null;
        }

        return response()->json($result);
    }

    public function update(Request $request)
    {
        $params = $request->all();

        foreach($params as $id => $value) {
            Equipment::where('id', $id)->update([
                "name" => $value
            ]);
        }
        return response()->json($request->all());
    }

    public function delete($id)
    {
        $equipment = Equipment::find($id);
        $transporter_order_detail = TransporterOrderDetail::select('*')->where('v_equipments', 'LIKE', '%'.$id.'%')->get();

        if ($equipment && $transporter_order_detail->isEmpty()) {
            $equipment->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'This equipment deleted successfully.',
                'style' => 'green rounded'
            ]);
        }
        else {
            return response()->json([
                'status' => 'error',
                'message' => "Can't delete this equipment because it has been already used in order.",
                'style' => 'red'
            ]);
        }
    }
}
