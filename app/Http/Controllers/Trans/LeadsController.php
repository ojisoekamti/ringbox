<?php

namespace App\Http\Controllers\Trans;

use App\Http\Controllers\Controller;
use App\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('leads')->select('*', 'contactpersons.name as contact', 'accounts.name as account', 'leads_scores.nama as status', 'leads_scores.score as score')
            ->join('accounts', 'leads.accountId', '=', 'accounts.id')
            ->join('leads_scores', 'leads.scoreId', '=', 'leads_scores.id')
            ->join('contactpersons', 'leads.contactId', '=', 'contactpersons.id')
            ->orderBy('leads.id', 'desc')->paginate(5);
        $page    = 1;
        $total   = DB::table('leads')->join('accounts', 'leads.accountId', '=', 'accounts.id')
            ->join('leads_scores', 'leads.scoreId', '=', 'leads_scores.id')
            ->join('contactpersons', 'leads.contactId', '=', 'contactpersons.id')->count();
        $perPage = 5;
        $showingTotal  = $page * $perPage;
        $showingStarted = $showingTotal - $perPage + 1;
        $showingTotal = ($showingTotal > $total) ? $total : $showingTotal;
        $table = array('showingStarted' => $showingStarted, 'showingTotal' => $showingTotal);
        $tableInfo = "Showing $showingStarted to $showingTotal of $total entries";

        return view('trans.leads.index', compact('data', 'tableInfo', 'table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = auth()->user();
        $maxN = DB::table('leads')->max('id');
        $leadsId = 'LEAD' . sprintf("%04d", $maxN+1);
        DB::table('actlists')->where('tempLeadId', '=', $leadsId)->delete();
        if ($request->accountId) {
            $accountData = DB::table('accounts')->select('id', 'name')->where('deleted_at', '=', null)->where('id', '=', $request->accountId)->get();
        }
        if ($request->contactid) {
            $contactData = DB::table('contactpersons')->where('deleted_at', '=', null)->where('id', '=', $request->contactid)->get();
        }
        $data = ['accountData' => ($accountData) ?? '', 'contactData' => ($contactData ?? '')];
        $leads_scores = DB::table('leads_scores')->get();
        // dd($leads_scores);
        return view ('trans.leads.create', [ 'user' => $user, 'leadsId' => $leadsId, 'data' => $data, 'leads_scores' => $leads_scores]);
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
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        $data = DB::table('leads')
            ->select(
                '*',
                'contactpersons.name as contact',
                'accounts.name as account',
                'leads_scores.nama as status',
                'leads_scores.score as score'
            )
            ->where(function ($query) use ($request) {
                $query->orWhere('contactpersons.name', 'like', '%' . $request->get('query') . '%')
                    ->orWhere('accounts.name', 'like', '%' . $request->get('query') . '%')
                    ->orWhere('leads_scores.nama', 'like', '%' . $request->get('query') . '%')
                    ->orWhere('leads.leadsId', 'like', '%' . $request->get('query') . '%');
            })
            ->join('accounts', 'leads.accountId', '=', 'accounts.id')
            ->join('leads_scores', 'leads.scoreId', '=', 'leads_scores.id')
            ->join('contactpersons', 'leads.contactId', '=', 'contactpersons.id')
            ->orderBy('leads.id', 'desc')->paginate(5);
        $page    = 1;
        $total   = DB::table('leads')->join('accounts', 'leads.accountId', '=', 'accounts.id')
            ->join('leads_scores', 'leads.scoreId', '=', 'leads_scores.id')
            ->join('contactpersons', 'leads.contactId', '=', 'contactpersons.id')->count();
        $perPage = 5;
        $showingTotal  = $page * $perPage;
        $showingStarted = $showingTotal - $perPage + 1;
        $showingTotal = ($showingTotal > $total) ? $total : $showingTotal;
        $table = array('showingStarted' => $showingStarted, 'showingTotal' => $showingTotal);
        $tableInfo = "Showing $showingStarted to $showingTotal of $total entries";
        // dd($data);
        return view('trans.leads.data', compact('data', 'tableInfo', 'table'));
    }
}
