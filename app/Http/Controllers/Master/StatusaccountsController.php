<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Statusaccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StatusaccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('statusaccounts')
        //->orderBy('created_at', 'desc')
        ->paginate(5);
        // dd($data->items());

        return view('master.statusaccounts.index', ['data'=>$data]);
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
     * @param  \App\Statusaccount  $statusaccount
     * @return \Illuminate\Http\Response
     */
    public function show(Statusaccount $statusaccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Statusaccount  $statusaccount
     * @return \Illuminate\Http\Response
     */
    public function edit(Statusaccount $statusaccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Statusaccount  $statusaccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Statusaccount $statusaccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Statusaccount  $statusaccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statusaccount $statusaccount)
    {
        //
    }
}
