<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\LeadsScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class leadsScoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\LeadsScore  $leadsScore
     * @return \Illuminate\Http\Response
     */
    public function show(LeadsScore $leadsScore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeadsScore  $leadsScore
     * @return \Illuminate\Http\Response
     */
    public function edit(LeadsScore $leadsScore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeadsScore  $leadsScore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeadsScore $leadsScore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeadsScore  $leadsScore
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeadsScore $leadsScore)
    {
        //
    }

    public function getScore(Request $request){
        if ($request->id) {
            $id = $request->id;
            $data = DB::table('leads_scores')->where('id', '=', $id)->get();
            return response()->json($data);
        }
    }
}
