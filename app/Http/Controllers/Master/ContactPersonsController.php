<?php

namespace App\Http\Controllers\Master;

use App\ContactPerson;
//use App\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactPersonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $data = DB::table('contactpersons')
            ->select('contactpersons.contactPersonId', 'contactpersons.id', 'contactpersons.name', 'contactpersons.city', 'contactpersons.phone', 'contactpersons.email', 'accounts.name as accountsname')
            ->where('accounts.deleted_at','=',null)
            ->join('accounts', 'contactpersons.accountId', '=', 'accounts.id')
            ->orderBy('contactpersons.id', 'desc');
        $data = $data->paginate(5);
        // dd($data);
        $total   = ContactPerson::count();
        //echo ($data->currentPage());
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
        return view('master.contactPersons.index', ['data' => $data, 'tableInfo' => $tableInfo, 'table' => $table]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $maxN = DB::table('contactPersons')->max('id');
        $conctactPersonId = 'CP' . sprintf("%03d", $maxN + 1);
        $accountData = '';
        $form = '';
        $type = '';
        $layout = 'layouts.app';
        // dd($request);
        if ($request->form == 'actlist') {
            if($request->accountId){
                $accountData = DB::table('accounts')->select('id', 'name')->where('deleted_at','=',null)->where('id', '=', $request->accountId)->get();
                return view('master.contactPersons.create', ['conctactPersonId' => $conctactPersonId,'form' =>$request->form, 'id' => $request->id,'accountData'=>$accountData,'type'=>$request->type,'layout'=>$layout]);
            }else{

            }
        }elseif ($request->form == 'modal') {
            $layout = 'layouts.modal';
            $accountData = DB::table('accounts')->select('id', 'name')->where('deleted_at','=',null)->where('id', '=', $request->accountId)->get();
            return view('master.contactPersons.create', ['conctactPersonId' => $conctactPersonId,'form' =>$request->form, 'id' => $request->id,'accountData'=>$accountData,'type'=>$request->type,'layout'=>$layout]);
        }else{
            return view('master.contactPersons.create', ['conctactPersonId' => $conctactPersonId, 'id' => $request->id,'accountData'=>$accountData,'form'=>$form,'layout'=>$layout]);
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
        // dd($request);
        $maxN = DB::table('contactPersons')->max('id');

        $contactPersonId = 'CP' . sprintf("%03d", $maxN + 1);
        $accountId = DB::table('accounts')->select('id')->where('name', $request->accountId)->max('id');
        // dump($request->accountId);
        // dd($accountId);
        $account = new ContactPerson();
        $account->contactPersonId = $request->contactPersonId ?? $contactPersonId;
        $account->accountId = $request->accountId ?? 43;
        $account->name = $request->name ?? '';
        $account->address = $request->address ?? '';
        $account->city = $request->city ?? '';
        $account->phone = $request->phone ?? '';
        $account->email = $request->email ?? '';
        $account->postalCode = $request->postalCode ?? '';
        $account->jobStatus = $request->jobStatus ?? '';

        $account->save();
        // dd($account);
        if($request->form=='actlist'){
            return redirect(route('admin.actlists.create',['type'=>$request->type,'accountId'=>$request->accountId,'contactid'=>$account->id]));
        } elseif ($request->form == 'modal') {
            return response($account);
        }else{
            return redirect(route('master.contactPersons.index'));
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactPerson  $contactPerson
     * @return \Illuminate\Http\Response
     */
    public function show(ContactPerson $contactPerson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactPerson  $contactPerson
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactPerson $contactPerson)
    {
        $acc = DB::table('accounts')->where('id', $contactPerson->accountId)->get();
        // dd($acc['name']);

        return view('master.contactPersons.edit', compact('contactPerson', 'acc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactPerson  $contactPerson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactPerson $contactPerson)
    {
        // dd($request);
        $affected = DB::table('contactpersons')
            ->where('id', $contactPerson->id)
            ->update([
                'contactPersonId' => $contactPerson->contactPersonId,
                'accountId' => $request->accountId,
                'name' => $request->name,
                'address' => $request->address,
                'city' => $request->city,
                'phone' => $request->phone,
                'email' => $request->email,
                'postalCode' => $request->postalCode,
                'jobStatus' => $request->jobStatus,
            ]);

        if ($affected) {
            return redirect(route('master.contactPersons.index'));
        } else {
            dump($request);
            dump($affected);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactPerson  $contactPerson
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactPerson $contactPerson)
    {

        //
        ContactPerson::destroy($contactPerson->id);

        return $contactPerson;
    }
    /**
     * load Data.
     *
     * @param  \App\ContactPerson  $contactPerson
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        // dump($request);
        if ($request->ajax()) {
            $data = DB::table('contactpersons')
                ->select('contactpersons.contactPersonId', 'contactpersons.id', 'contactpersons.name', 'contactpersons.city', 'contactpersons.phone', 'contactpersons.email', 'accounts.name as accountsname')
                ->join('accounts', 'contactpersons.accountId', '=', 'accounts.id')
                ->where('accounts.deleted_at','=',null)
                ->where(function($query) use ($request){
                    $query->orwhere('contactpersons.contactPersonId', 'like', '%' . $request->get('query') . '%')
                    ->orWhere('contactpersons.name', 'like', '%' . $request->get('query') . '%')
                    ->orWhere('contactpersons.address', 'like', '%' . $request->get('query') . '%')
                    ->orWhere('contactpersons.city', 'like', '%' . $request->get('query') . '%')
                    ->orWhere('contactpersons.phone', 'like', '%' . $request->get('query') . '%')
                    ->orWhere('contactpersons.email', 'like', '%' . $request->get('query') . '%');
                })
                ->orderBy('contactpersons.id', 'desc')
                ->paginate(5);
            $page    = $request->has('page') ? $request->get('page') : 1;
            $total   = ContactPerson::count();
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
            return view('master.contactPersons.data', ['data' => $data, 'tableInfo' => $tableInfo, 'table' => $table]);
        }
    }


    public function fetch(Request $request)
    {
        if ($request) {
            $cari = $request->q;
            $accountId = $request->accountId;
            $data = DB::table('contactpersons')->select('id', 'name')->where('name', 'LIKE', '%' . $cari . '%');
            if ($accountId != null) {
                $data->where('accountId', '=', $accountId);
            }
            $data = $data->get();
            return response()->json($data);
        }
    }

    public function fetch_data(Request $request)
    {
        if ($request->id) {
            $id = $request->id;
            $data = DB::table('contactpersons')->where('deleted_at', '=', null)->where('id', '=', $id)->get();
            return response()->json($data);
        }
    }
}
