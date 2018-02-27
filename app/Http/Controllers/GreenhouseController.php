<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class GreenhouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blocks = DB::table('blocks')->get();
        $sheds = DB::table('sheds')->get();
        return view('admin.greenhouse.index',compact('blocks', 'sheds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.greenhouse.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBlock(Request $request)
    {
        $block = $request->input('block_name');
        DB::insert('insert into blocks (block_name) values(?)',[$block]);
        return redirect()->route('admin.greenhouse.index');
    }

    public function storeShed(Request $request)
    {
        $shed = $request->input('shed_name');
        DB::insert('insert into sheds (shed_name) values(?)',[$shed]);
        return redirect()->route('admin.greenhouse.index');
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
    public function editBlock(Request $request,$id)
    {
        $blocks = DB::select('select * from blocks where id = ?',[$id]);
        return view('admin.greenhouse.editblock',['blocks'=>$blocks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBlock(Request $request, $id)
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
}
