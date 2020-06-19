<?php

namespace App\Http\Controllers\Admin;

use App\Actlist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActlistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('actlists')
            ->select(
                'actlists.actId',
                'actlists.id',
                'actlists.idSales',
                'actlists.idType',
                'actlists.subject',
                'actlists.date',
                'actlists.remarks',
                'actlists.estimateTime',
                'actlists.clockIn',
                'actlists.clockOut',
                'actlists.status',
                'accounts.name',
            )
            ->join('accounts', 'actlists.accountId', '=', 'accounts.id')
            ->whereNull('actlists.tempLeadId')
            ->orderBy('actlists.id', 'desc')
            ->paginate(5);
        // dump($data);
        $page    = 1;
        $total   = DB::table('actlists')->join('accounts', 'actlists.accountId', '=', 'accounts.id')->whereNull('actlists.tempLeadId')->count();
        $perPage = 5;
        $showingTotal  = $page * $perPage;
        $showingStarted = $showingTotal - $perPage + 1;
        $showingTotal = ($showingTotal > $total) ? $total : $showingTotal;
        $tableInfo = "Showing $showingStarted to $showingTotal of $total entries";

        $countApp = DB::table('actlists')->where('actlists.idType', '1')->join('accounts', 'actlists.accountId', '=', 'accounts.id')->whereNull('actlists.tempLeadId')->count();
        $countEm = DB::table('actlists')->where('actlists.idType', '2')->join('accounts', 'actlists.accountId', '=', 'accounts.id')->whereNull('actlists.tempLeadId')->count();
        $countPh = DB::table('actlists')->where('actlists.idType', '3')->join('accounts', 'actlists.accountId', '=', 'accounts.id')->whereNull('actlists.tempLeadId')->count();
        $count = array('countApp' => $countApp, 'countEm' => $countEm, 'countPh' => $countPh);
        return view('admin.actlists.index', ['data' => $data, 'tableinfo' => $tableInfo, 'count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = $request->type;
        $form = $request->form;
        $layout = 'layouts.app';
        $user = auth()->user();
        $head = '';
        if ($type == '1') {
            $head = 'AP';
        } elseif ($type == '2') {
            $head = 'EM';
        } else {
            $head = 'PH';
        }

        $maxN = DB::table('actlists')->max('id');

        $actId = $head . '' . sprintf("%04d", $maxN);
        if ($request->accountId) {
            $accountData = DB::table('accounts')->select('id', 'name')->where('deleted_at', '=', null)->where('id', '=', $request->accountId)->get();
        }
        if ($request->contactid) {
            $contactData = DB::table('contactpersons')->where('deleted_at', '=', null)->where('id', '=', $request->contactid)->get();
        }
        $data = ['accountData' => ($accountData) ?? '', 'contactData' => ($contactData ?? '')];
        if ($form == 'modal') {
            $layout = 'layouts.modal';
            return view('admin.actlists.create', ['type' => $type, 'user' => $user, 'actId' => $actId, 'data' => $data, 'layout' => $layout, 'form' => $form]);
        } else {
            return view('admin.actlists.create', ['type' => $type, 'user' => $user, 'actId' => $actId, 'data' => $data, 'layout' => $layout]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->idType == '1') {
            $head = 'AP';
        } elseif ($request->idType == '2') {
            $head = 'EM';
        } else {
            $head = 'PH';
        }

        $maxN = DB::table('actlists')->max('id');

        $actId = $head . '' . sprintf("%04d", $maxN);
        // dd($request);
        $actlist = new Actlist;
        $actlist->actId = $request->actId ?? $actId;
        $actlist->idSales = $request->idSales ?? '';
        $actlist->accountId = $request->accountId ?? '';
        $actlist->contactPersonId = $request->contactPersonId ?? '';
        $actlist->date = $request->date ?? '';
        $actlist->subject = $request->subject ?? '';
        $actlist->remarks = $request->remark ?? '';
        $actlist->estimateTime = $request->estimateTime ?? '00:00:00';
        $actlist->clockIn = $request->clockIn ?? '00:00:00';
        $actlist->clockOut = $request->clockOut ?? '00:00:00';
        $actlist->idType = $request->idType ?? '';
        $actlist->leadId = $request->leadId ?? 0;
        $actlist->tempLeadId = $request->tempLeadId ?? null;
        $actlist->status = ($request->save == 'save') ? 1 : 2;

        $actlist->save();
        if ($request->form === 'modal') {
            return response($actlist);
        } else {
            return redirect(route('admin.actlists.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Actlist  $actlist
     * @return \Illuminate\Http\Response
     */
    public function show(Actlist $actlist)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actlist  $actlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Actlist $actlist)
    {
        $type = $actlist->idType;
        $user = auth()->user();
        $actId = $actlist->actId;
        $data = '';
        $accountData = '';
        $contactData = '';
        $accountData = DB::table('accounts')->where('deleted_at', '=', null)->where('id', '=', $actlist->accountId)->get();
        $contactData = DB::table('contactpersons')->where('deleted_at', '=', null)->where('id', '=', $actlist->contactPersonId)->get();

        $data = ['accountData' => ($accountData) ?? '', 'contactData' => ($contactData ?? '')];

        return view('admin.actlists.edit', ['type' => $type, 'user' => $user, 'actId' => $actId, 'data' => $data, 'actlist' => $actlist]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actlist  $actlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actlist $actlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actlist  $actlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actlist $actlist)
    {
        //
    }


    public function data(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('actlists')
                ->select(
                    'actlists.actId',
                    'actlists.id',
                    'actlists.idSales',
                    'actlists.idType',
                    'actlists.subject',
                    'actlists.date',
                    'actlists.remarks',
                    'actlists.estimateTime',
                    'actlists.clockIn',
                    'actlists.clockOut',
                    'actlists.status',
                    'accounts.name',
                )
                ->join('accounts', 'actlists.accountId', '=', 'accounts.id')
                ->where('actlists.idType', 'like', '%' . $request->get('type') . '%')
                ->whereNull('actlists.tempLeadId')
                ->where(function ($query) use ($request) {
                    $query->orWhere('accounts.name', 'like', '%' . $request->get('query') . '%')
                        ->orWhere('actlists.subject', 'like', '%' . $request->get('query') . '%');
                })
                ->orderBy('actlists.id', 'desc')


                // ->orWhere('.actlistcontactName', 'like', '%' . $request->get('query') . '%')
                // ->orWhere('phoneCall', 'like', '%' . $request->get('query') . '%')
                // ->orWhere('email', 'like', '%' . $request->get('query') . '%')
                // ->orWhere('remarks', 'like', '%' . $request->get('query') . '%')
                ->paginate(5);
            // dd($data);
            $page    = $request->has('page') ? $request->get('page') : 1;
            $total   = DB::table('actlists')->join('accounts', 'actlists.accountId', '=', 'accounts.id')->whereNull('actlists.tempLeadId')->count();
            //echo ($data->currentPage());
            $perPage = 5;
            $showingTotal  = $page * $perPage;
            $showingStarted = $showingTotal - $perPage + 1;
            $showingTotal = ($showingTotal > $total) ? $total : $showingTotal;
            // dd($data->total());

            if ($data->total() < 5) {
                $showingTotal = $data->total();
            }
            $tableInfo = "Showing $showingStarted to $showingTotal of $total entries";
            return view('admin.actlists.data', ['data' => $data, 'tableinfo' => $tableInfo]);
        }
    }

    public function checInOut(Request $request)
    {

        $data = DB::table('actlists')
            ->where('id', $request->id)
            ->get();
        // dd($data[0]->clockIn);
        if ($data[0]->clockIn == '00:00:00') {
            $clockIn = date("H:i");
            $clockOut = date("H:i", strtotime('00:00:00'));
        } else {
            $clockIn = date("H:i", strtotime($data[0]->clockIn));
            $clockOut = date("H:i");
        }
        // dd(date('H:i'));
        if ($data[0]->idType == 1) {
            $affected = DB::table('actlists')
                ->where('id', $request->id)
                ->update(['clockIn' => $clockIn, 'clockOut' => $clockOut]);
        } else {
            $affected = DB::table('actlists')
                ->where('id', $request->id)
                ->update(['status' => 2]);
        }
        if ($affected) {
            return redirect(route('admin.actlists.index'));
        }
    }

    public function fetchActlist(Request $request){

        $data = DB::table('actlists')
        ->select(
            'actlists.actId',
            'actlists.id',
            'actlists.idSales',
            'actlists.idType',
            'actlists.subject',
            'actlists.date',
            'actlists.remarks',
            'actlists.estimateTime',
            'actlists.clockIn',
            'actlists.clockOut',
            'actlists.status',
            'accounts.name',
        )
        ->join('accounts', 'actlists.accountId', '=', 'accounts.id')
        ->where('actlists.tempLeadId','=',$request->leadsId)
        ->orderBy('actlists.id', 'desc')->get();

        return response($data);
    }
}
