<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
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
		date_default_timezone_set('Australia/Brisbane');
        $date = date('Y-m-d H:i:s');
        $blocks = Block::pluck('block_name', 'id');
        $sheds = Shed::pluck('shed_name', 'id');
        $chemicals = Chemical::pluck('trade_name', 'id');

        $user = Auth::user();
       return view('admin.timekeeping.index',compact('times', 'tasks', 'blocks', 'sheds', 'chemicals', 'user','date'));

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
		$time = new Time();
        $time->start_time = $request->startTimeContainer;
        $time->task_id = $request->myId;
        $time->save();
        return redirect()->route('admin.timekeeping.index');
    }
    
     public function insert(Request $request)
    {
		 $time = new Time();
		 $startTimeContainer = $request->startTimeContainer;
		 $stopTimeContainer = $request->stopTimeContainer;
		 //~ DB::table('times')->where('start_time',$startTimeContainer)->update(['end_time'=>$stopTimeContainer]);
		 DB::table('times')->where('start_time',$startTimeContainer)->update(['end_time'=>$stopTimeContainer]);
		 return redirect()->route('admin.timekeeping.index');
	}
    
    public function insertStartTime(Request $request)
    {
		
		$time = new Time();
        $time->start_time = $request->startTimeContainer;
        $time->task_id = $request->id;
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

    public function autocomplete(Request $request)
    {
        $term=$request->term;
        $queries = Chemical::where('trade_name','LIKE','%'.$term.'%')->take(5)->get();
        $result=array();
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->trade_name ];
        }
        return Response::json($results);
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
                $data[]=array('trade_name'=>$chemical->trade_name, 'components'=>$chemical->components,'rates'=>$chemical->rates, 'withhold_period'=>$chemical->withhold_period, 'pest_disease'=>$chemical->pest_disease,);
        }
        if(count($data))
             return $data;
        else
            return ['trade_name'=>'','components'=>'','rates'=>'','withhold_period'=>'','pest_disease'=>''];
    }

}
