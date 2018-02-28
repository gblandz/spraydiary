<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Chemical;
Use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ChemicalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$chemicals = Chemical::all();
        return view('admin.chemicals.index', compact('chemicals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.chemicals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chemical = new Chemical();
        $chemical->chem_type = $request->chem_type;
        $chemical->trade_name = $request->trade_name;
        $chemical->components = $request->components;
        $chemical->rates = $request->rates;
        $chemical->withhold_period = $request->withhold_period;
        $chemical->pest_disease = $request->pest_disease;
        $chemical->save();
        return redirect()->route('admin.chemicals.index');
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
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $chemical = Chemical::find($id);

        return view('admin.chemicals.edit', compact('chemical'));
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
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $chemical = Chemical::findOrFail($id);
        $chemical->update($request->all());

        return redirect()->route('admin.chemicals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $chemical = Chemical::findOrFail($id);
        $chemical->delete();

        return redirect()->route('admin.chemicals.index');
    }
}
