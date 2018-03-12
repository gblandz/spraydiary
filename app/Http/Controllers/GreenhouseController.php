<?php

namespace App\Http\Controllers;

use App\Block;
use App\Shed;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;


class GreenhouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401, 'Access Denied.');
        }

        $blocks = Block::all();
        $sheds = Shed::all();
        return view('admin.greenhouse.index',compact('blocks', 'sheds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401, 'Access Denied.');
        }

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
        if (! Gate::allows('users_manage')) {
            return abort(401, 'Access Denied.');
        }

        $block = $request->input('block_name');
        DB::insert('insert into blocks (block_name) values(?)',[$block]);
        return redirect()->route('admin.greenhouse.index');
    }

    public function storeShed(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401, 'Access Denied.');
        }

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
    public function editBlock($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401, 'Access Denied.');
        }
        $block = Block::find($id);
        return view('admin.greenhouse.editblock', compact('block'));
    }

    public function editShed($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401, 'Access Denied.');
        }
        $shed = Shed::find($id);
        return view('admin.greenhouse.editshed', compact('shed'));
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
        if (! Gate::allows('users_manage')) {
            return abort(401, 'Access Denied.');
        }

        $block = Block::findOrFail($id);
        $block->update($request->all());

        return redirect()->route('admin.greenhouse.index');
    }

    public function updateShed(Request $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401, 'Access Denied.');
        }
        $shed = Shed::findOrFail($id);
        $shed->update($request->all());

        return redirect()->route('admin.greenhouse.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyBlock($id)
    {
         if (! Gate::allows('users_manage')) {
            return abort(401, 'Access Denied.');
        }
        $block = Block::findOrFail($id);
        $block->delete();

        return redirect()->route('admin.greenhouse.index');
    }

    public function destroyShed($id)
    {
         if (! Gate::allows('users_manage')) {
            return abort(401, 'Access Denied.');
        }
        $shed = Shed::findOrFail($id);
        $shed->delete();

        return redirect()->route('admin.greenhouse.index');
    }
}
