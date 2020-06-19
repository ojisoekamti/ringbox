@extends('layouts.app')
@section('title', 'Account Update')
@section('content')
<!-- Begin Page Content -->
<div class="container ">
    <div class="card">
        <div class="card-header">
            @yield('title')
        </div>
        <div class="card-body">

            <form action="{{ route('master.accounts.update',$account->id) }}" method="post">
                @method('patch')
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="accountId">Account Id</label>
                            <input type="text" class="form-control" id="accountId" name="accountId" value="{{$account->accountId}}" disabled>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="name">Account Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$account->name}}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" cols="20" rows="5" class="form-control" required>{{$account->address}}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{$account->city}}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{$account->phone}}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">E-mail</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{$account->email}}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="postalCode">Postal Code</label>
                            <input type="text" class="form-control" id="postalCode" name="postalCode" value="{{$account->postalCode}}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="idStatusAccount">Status Account</label>
                            <select class="custom-select" name="idStatusAccount">
                                {{-- <option selected>Select Status</option> --}}
                                <option value="1" {{($account->idStatusAccount==1)?'selected':''}}>Prospect</option>
                                <option value="2" {{($account->idStatusAccount==2)?'selected':''}}>Fix</option>
                              </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="idStatusAccount">Type Account</label>
                            <select class="custom-select" name="idType">
                                <option selected>Select Type</option>
                                <option value="1" {{($account->idType==1)?'selected':''}}>Corporate</option>
                                <option value="2" {{($account->idType==2)?'selected':''}}>Personal</option>
                              </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<br />
@endsection
