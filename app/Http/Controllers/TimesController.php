<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Auth;
use Response;
use App\Time;
use App\Task;
use App\User;
use App\Block;
use App\Shed;
use App\Chemical;

class TimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $times = Time::all();
        $tasks = Auth::user()->tasks->pluck('description', 'id');
        $blocks = Block::pluck('block_name', 'id');
        $sheds = Shed::pluck('shed_name', 'id');
        $chemicals = Chemical::pluck('trade_name', 'id');
        $user = Auth::user();
       return view('admin.timekeeping.index',compact('times', 'tasks', 'blocks', 'sheds', 'chemicals', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(Input::all());
        $time = new Time();
        $time->task_id = $request->task_id;
        $time->block_id = $request->block_id;
        $time->sheds = implode(',', $request->sheds);
        $time->chemical_id = $request->chemical_id;
        $time->tank_capacity = $request->tank_capacity;
        $time->total_liquid = $request->total_liquid;
        $time->is_fruiting = $request->is_fruiting;
        $time->sprayed_by = Auth::id();   

        $time->save();
        return redirect()->route('admin.timekeeping.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchResponse(Request $request){
        $query = $request->get('term','');
        $chemicals=\DB::table('chemicals');
        if($request->type=='trade_name'){
            $chemicals->where('trade_name','LIKE','%'.$query.'%');
        }
        $chemicals=$chemicals->get();        
        $data=array();
        foreach ($chemicals as $chemical) {
                $data[]=array('id'=>$chemical->id, 'trade_name'=>$chemical->trade_name, 'components'=>$chemical->components,'rates'=>$chemical->rates, 'withhold_period'=>$chemical->withhold_period, 'pest_disease'=>$chemical->pest_disease,);
        }
        if(count($data))
             return $data;
        else
            return ['id'=>'', 'trade_name'=>'','components'=>'','rates'=>'','withhold_period'=>'','pest_disease'=>''];
    }

    public function autoliquidTotal(Request $request)
    {
        $term = Str::lower(Input::get('term'));
        $range1 = range(1,15);
        $range2 = range(50,2000,50);
        $data = array_merge($range1,$range2);
        $return_array = array();

        foreach ($data as $k => $v) {
            if (strpos(Str::lower($v), $term) !== FALSE) {
                $return_array[] = array('value' => $v, 'id' =>$k);
            }
        }
        return Response::json($return_array);
    }

}
