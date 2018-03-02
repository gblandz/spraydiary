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
        //
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
}
