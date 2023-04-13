<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;
use App\Models\LoadAddress;

class LoadAddressController extends Controller
{
    public function index()
    {
        $loadAddress = LoadAddress::select('*')->get();
        return view('loadAddress/list', ['addrs' => $loadAddress]);
    }

    public function create(Request $request)
    {
        $n_load_name = $request->n_load_name;
        $n_address_1 = $request->n_address_1;
        $n_address_2 = $request->n_address_2;
        $n_address_3 = $request->n_address_3;
        $n_city = $request->n_city;
        $n_province_1 = $request->n_province_1;
        $n_province_2 = $request->n_province_2;

        $result = 0;
        try{
            $new_loadAddr = LoadAddress::create(
            [
                'name' => $n_load_name,
                'address1' => $n_address_1,
                'address2' => $n_address_2,
                'address3' => $n_address_3,
                'city' => $n_city,
                'province1' => $n_province_1,
                'province2' => $n_province_2

            ]);

            if($new_loadAddr){
                $result = $new_loadAddr->id;
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
        $e_loadAddr_id = $request->e_loadAddr_id;
        $e_load_name = $request->e_load_name;
        $e_address_1 = $request->e_address_1;
        $e_address_2 = $request->e_address_2;
        $e_address_3 = $request->e_address_3;
        $e_city = $request->e_city;
        $e_province_1 = $request->e_province_1;
        $e_province_2 = $request->e_province_2;

        $result = 0;
        try{
            LoadAddress::where('id', $e_loadAddr_id)->update(
            [
                'name' => $e_load_name,
                'address1' => $e_address_1,
                'address2' => $e_address_2,
                'address3' => $e_address_3,
                'city' => $e_city,
                'province1' => $e_province_1,
                'province2' => $e_province_2
            ]);

            $result = $e_loadAddr_id;
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
        $remove_loadAddr_id = $request->remove_loadAddr_id;

        $result = 0;
        try{
            $remove_loadAddr = LoadAddress::where('id', $remove_loadAddr_id);
            if($remove_loadAddr){
                $remove_loadAddr->delete();
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
