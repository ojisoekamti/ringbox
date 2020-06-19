<?php

namespace App\Http\Controllers\Master;

use App\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('accounts')
            ->join('type_account', 'accounts.idType', '=', 'type_account.id')
            ->join('statusaccounts', 'accounts.idStatusAccount', '=', 'statusaccounts.id')
            ->select('accounts.accountId', 'accounts.id', 'accounts.name', 'accounts.email', 'accounts.city', 'accounts.phone', 'type_account.name as type', 'statusaccounts.name as status', 'accounts.deleted_at')
            ->where('accounts.deleted_at', '=', null)->orderBy('accounts.accountId', 'desc');
        $data = $data->paginate(5);
        $total   = Account::count();
        //echo ($data->currentPage());
        // dump($data);
        $perPage = 5;
        $showingTotal  = $perPage;
        $showingStarted = $showingTotal - $perPage + 1;
        $showingTotal = ($showingTotal > $total) ? $total : $showingTotal;
        // dd($data->total());

        if ($data->total() < 5) {
            $showingTotal = $data->total();
        }
        $tableInfo = "Showing $showingStarted to $showingTotal of $total entries";

        $table = array('showingStarted' => $showingStarted, 'showingTotal' => $showingTotal);
        return view('master.accounts.index', ['data' => $data, 'tableInfo' => $tableInfo, 'table' => $table]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $maxN = DB::table('accounts')->max('id');
        $accountId = 'ACNT' . sprintf("%04d", $maxN + 1);
        $form = $request->form;
        $type = $request->type;
        // dd($actlist);
        // dd($request);
        if ($request->form == 'modal') {
            $layout = 'layouts.modal';
            return view('master.accounts.create', compact('accountId', 'form', 'type', 'layout'));
        }
        $layout = 'layouts.app';
        return view('master.accounts.create', compact('accountId', 'form', 'type','layout'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $maxN = DB::table('accounts')->max('id');

        $accountId = 'ACNT' . sprintf("%04d", $maxN + 1);
        // dd($request);
        $account = new Account;
        $account->accountId = $request->accountId ?? $accountId;
        $account->name = $request->name ?? '';
        $account->address = $request->address ?? '';
        $account->city = $request->city ?? '';
        $account->phone = $request->phone ?? '';
        $account->email = $request->email ?? '';
        $account->idStatusAccount = $request->idStatusAccount ?? '';
        $account->postalCode = $request->postalCode ?? '';
        $account->idGroup = $request->idGroup ?? 1;
        $account->idType = $request->idType ?? 1;

        $account->save();
        if ($request->form == 'actlist') {
            return redirect(route('admin.actlists.create', ['type' => $request->type, 'accountId' => $account->id]));
        } elseif ($request->form == 'modal') {
            return response($account);
        } else {
            return redirect(route('master.accounts.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return view('master.accounts.edit', compact('account'));
        // return $account;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $affected = DB::table('accounts')
            ->where('id', $account->id)
            ->update([
                'name' => $request->name,
                'address' => $request->address,
                'city' => $request->city,
                'phone' => $request->phone,
                'email' => $request->email,
                'idStatusAccount' => $request->idStatusAccount,
                'postalCode' => $request->postalCode,
                'idGroup' => 1,
                'idType' => $request->idType,
            ]);

        if ($affected) {
            return redirect(route('master.accounts.index'));
        } else {
            dump($request);
            dump($affected);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
        Account::destroy($account->id);

        return $account;
    }

    public function data(Request $request)
    {


        if ($request->ajax()) {
            $data = DB::table('accounts')
                ->join('type_account', 'accounts.idType', '=', 'type_account.id')
                ->join('statusaccounts', 'accounts.idStatusAccount', '=', 'statusaccounts.id')
                ->select('accounts.accountId', 'accounts.id', 'accounts.name', 'accounts.email', 'accounts.city', 'accounts.phone', 'type_account.name as type', 'statusaccounts.name as status', 'accounts.deleted_at')
                ->where('accounts.deleted_at', null)
                ->where(function ($query) use ($request) {
                    $query->orWhere('accounts.accountId', 'like', '%' . $request->get('query') . '%')
                        ->orWhere('accounts.name', 'like', '%' . $request->get('query') . '%')
                        ->orWhere('accounts.address', 'like', '%' . $request->get('query') . '%')
                        ->orWhere('accounts.city', 'like', '%' . $request->get('query') . '%')
                        ->orWhere('accounts.phone', 'like', '%' . $request->get('query') . '%')
                        ->orWhere('accounts.email', 'like', '%' . $request->get('query') . '%');
                })
                ->orderBy('accounts.id', 'desc')
                ->paginate(5);
            // dump($data);
            $page    = $request->has('page') ? $request->get('page') : 1;
            $total   = Account::count();
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
            $table = array('showingStarted' => $showingStarted, 'showingTotal' => $showingTotal);
            return view('master.accounts.data', ['data' => $data, 'tableInfo' => $tableInfo, 'table' => $table]);
        }
    }

    public function fetch(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('accounts')->select('id', 'name')->where('deleted_at', '=', null)->where('name', 'LIKE', '%' . $cari . '%')->get();
            return response()->json($data);
        }
    }

    public function fetch_data(Request $request)
    {
        if ($request->id) {
            $id = $request->id;
            $data = DB::table('accounts')->where('deleted_at', '=', null)->where('id', '=', $id)->get();
            return response()->json($data);
        }
    }
}
