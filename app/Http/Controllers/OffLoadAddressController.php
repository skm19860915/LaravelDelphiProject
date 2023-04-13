<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;
use App\Models\OffLoadAddress;

class OffLoadAddressController extends Controller
{
    public function index()
    {
        $offLoadAddress = OffLoadAddress::select('*')->get();
        return view('offLoadAddress/list', ['addrs' => $offLoadAddress]);
    }

    public function create(Request $request)
    {
        $n_offload_name = $request->n_offload_name;
        $n_address_1 = $request->n_address_1;
        $n_address_2 = $request->n_address_2;
        $n_address_3 = $request->n_address_3;
        $n_city = $request->n_city;
        $n_province_1 = $request->n_province_1;
        $n_province_2 = $request->n_province_2;

        $result = 0;
        try{
            $new_offloadAddr = OffLoadAddress::create(
            [
                'name' => $n_offload_name,
                'address1' => $n_address_1,
                'address2' => $n_address_2,
                'address3' => $n_address_3,
                'city' => $n_city,
                'province1' => $n_province_1,
                'province2' => $n_province_2

            ]);

            if($new_offloadAddr){
                $result = $new_offloadAddr->id;;
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
        $e_offloadAddr_id = $request->e_offloadAddr_id;
        $e_offload_name = $request->e_offload_name;
        $e_address_1 = $request->e_address_1;
        $e_address_2 = $request->e_address_2;
        $e_address_3 = $request->e_address_3;
        $e_city = $request->e_city;
        $e_province_1 = $request->e_province_1;
        $e_province_2 = $request->e_province_2;

        $result = 0;
        try{
            OffLoadAddress::where('id', $e_offloadAddr_id)->update(
            [
                'name' => $e_offload_name,
                'address1' => $e_address_1,
                'address2' => $e_address_2,
                'address3' => $e_address_3,
                'city' => $e_city,
                'province1' => $e_province_1,
                'province2' => $e_province_2
            ]);

            $result = $e_offloadAddr_id;
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
        $remove_offloadAddr_id = $request->remove_offloadAddr_id;

        $result = 0;
        try{
            $remove_offloadAddr = OffLoadAddress::where('id', $remove_offloadAddr_id);
            if($remove_offloadAddr){
                $remove_offloadAddr->delete();
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
}
