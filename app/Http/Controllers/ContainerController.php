<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;
use App\Models\Container;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TrackingContainerView;

class ContainerController extends Controller
{
    public function index()
    {
        $containers = Container::select('*')->get();
        return view('container.index', ['containers' => $containers]);
    }

    public function create(Request $request)
    {
        $container_name = $request->container_name;

        $result = 0;
        try{
            $new_container = Container::create(
            [
                'name' => $container_name,
            ]);

            if($new_container){
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
        $edit_container_id = $request->edit_container_id;
        $edit_container_name = $request->edit_container_name;

        $result = 0;
        try{
            Container::where('id', $edit_container_id)->update(
            [
                'name' => $edit_container_name
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

    public function remove(Request $request)
    {
        $remove_container_id = $request->remove_container_id;

        $result = 0;
        try{
            $remove_container = Container::where('id', $remove_container_id);
            if($remove_container){
                $remove_container->delete();
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

    public function export()
    {
        return Excel::download(new TrackingContainerView(), 'Tracking Container '.now()->format('Y-m-d').'.xlsx');
    }
}
