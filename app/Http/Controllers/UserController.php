<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class UserController extends Controller
{
    function getManagers()
    {
        $admins = User::select('*')
                ->join('authorities', 'authorities.id', '=', 'users.level')
                ->select('users.id as id', 'users.name as name', 'users.email as email', 'authorities.name as level')
                ->where('users.level', '=', 1)
                ->orWhere('users.level', '=', 2)
                ->get();
        return view('user/admins', ['admins' => $admins]);
    }

    public function createUser(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        $result = 0;
        try{
            $new_customer = User::create(
            [
                'name' => $name,
                'level' => 2,
                'email' => $email,
                'password' => Hash::make($password),
                'remember_token' => str_random(10)
            ]);

            if($new_customer){
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

    public function removeUser(Request $request)
    {
        $remove_user_id = $request->remove_user_id;

        $result = 0;
        try{
            $remove_user = User::where('id', $remove_user_id);
            if($remove_user){
                $remove_user->delete();
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

    function getCustomers()
    {
        $customers = User::select('*')
                ->join('authorities', 'authorities.id', '=', 'users.level')
                ->select('users.id as id', 'users.name as name', 'users.email as email', 'authorities.name as level')
                ->where('users.level', '>', 2)
                ->get();
        return view('user/customers', ['customers' => $customers]);
    }

    public function createCustomer(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        $result = 0;
        try{
            $new_customer = User::create(
            [
                'name' => $name,
                'level' => 3,
                'email' => $email,
                'password' => Hash::make($password),
                'remember_token' => str_random(10)
            ]);

            if($new_customer){
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

    public function editCustomer(Request $request)
    {
        $edit_user_id = $request->edit_user_id;
        $edit_name = $request->edit_name;
        $edit_email = $request->edit_email;

        $result = 0;
        try{
            User::where('id', $edit_user_id)->update(
            [
                'name' => $edit_name,
                'email' => $edit_email
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

    public function removeCustomer(Request $request)
    {
        $remove_customer_id = $request->remove_customer_id;

        $result = 0;
        try{
            $remove_customer = User::where('id', $remove_customer_id);
            if($remove_customer){
                $remove_customer->delete();
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
