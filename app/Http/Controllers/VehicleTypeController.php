<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleType;
use App\Models\TransporterOrderDetail;

class VehicleTypeController extends Controller
{
    public function get()
    {
        $vehicleTypes = VehicleType::select('*')->get();
        return response()->json($vehicleTypes);
    }

    public function create(Request $request)
    {
        $vehicle_type_name = $request->vehicle_type_name;

        $result = 0;
        try{
            $new_vehicle_type = VehicleType::create(
            [
                'name' => $vehicle_type_name
            ]);

            if($new_vehicle_type){
                $result = $new_vehicle_type->id;
            }
        }
        catch(QueryException $e){
            $result = 0;
        }
        catch(Exception $e){
            $result = -1;
        }

        return response()->json($result);
    }

    public function update(Request $request)
    {
        $params = $request->all();

        foreach($params as $id => $value) {
            VehicleType::where('id', $id)->update([
                "name" => $value
            ]);
        }
        return response()->json($request->all());
    }

    public function delete($id)
    {
        $vehicleType = VehicleType::find($id);

        $transporter_order_detail = TransporterOrderDetail::select('*')->where('v_type_id', $id)->get();

        if ($vehicleType && $transporter_order_detail->isEmpty()) {
            $vehicleType->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'This vehicle type deleted successfully.',
                'style' => 'green rounded'
            ]);
        }
        else {
            return response()->json([
                'status' => 'error',
                'message' => "Can't delete this vehicle type because it has been already used in order.",
                'style' => 'red'
            ]);
        }
    }
}
