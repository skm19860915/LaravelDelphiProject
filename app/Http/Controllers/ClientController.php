<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;
use App\Models\Client;
use App\Models\ClientOrder;

class ClientController extends Controller
{
    public function index()
    {
        return view('client/index');
    }

    public function getClientList()
    {
        $clients = Client::select('*')->get();
        return view('client/list', ['clients' => $clients]);
    }

    public function getAllClients()
    {
        $clients = Client::select('*')->get();
        return response()->json(['success' => $clients]);
    }

    public function add(Request $request)
    {
        $order_id = $request->order_id;
        $add_client_id = $request->add_client_id;

        $result = 0;
        try{
            $existing_record = ClientOrder::select('*')->where('order_id', $order_id)->where('client_id', $add_client_id)->first();
            if(empty($existing_record)){
                ClientOrder::create(['order_id' => $order_id, 'client_id' => $add_client_id]);
            }
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

    public function create(Request $request)
    {
        $account_no = $request->account_no;
        $client_name = $request->client_name;
        $client_address1 = $request->client_address1;

        $result = 0;
        try{
            $new_client = Client::create(
            [
                'account_no' => $account_no,
                'name' => $client_name,
                'address1' => $client_address1
            ]);

            if($new_client){
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
        $edit_client_id = $request->edit_client_id;
        $edit_account_no = $request->edit_account_no;
        $edit_client_name = $request->edit_client_name;
        $edit_client_address1 = $request->edit_client_address1;

        $result = 0;
        try{
            Client::where('id', $edit_client_id)->update(
            [
                'account_no' => $edit_account_no,
                'name' => $edit_client_name,
                'address1' => $edit_client_address1
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
        $delete_client_id = $request->delete_client_id;

        $result = 0;
        try{
            $delete_order_client = ClientOrder::where('order_id', $order_id)->where('client_id', $delete_client_id);

            if($delete_order_client){
                $delete_order_client->delete();
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
        $remove_client_id = $request->remove_client_id;

        $result = 0;
        try{
            $remove_order_clients = ClientOrder::where('client_id', $remove_client_id);

            if($remove_order_clients){
                $remove_order_clients->delete();
            }

            $remove_client = Client::where('id', $remove_client_id);
            if($remove_client){
                $remove_client->delete();
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
