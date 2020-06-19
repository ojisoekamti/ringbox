@extends($layout)
@section('title', 'Contact Create')
@section('content')
{{-- @dump($accountData) --}}
<!-- Begin Page Content -->
<div class="container ">
    <div class="card">
        <div class="card-header">
            @yield('title')
        </div>
        <div class="card-body">

            <form action="{{ route('master.contactPersons.store') }}" method="post" id="formAct">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="conctactPersonId">Contact Id</label>
                            <input type="text" class="form-control" id="conctactPersonId" name="conctactPersonId"
                                value="{{$conctactPersonId}}" disabled>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="accountId">Account Name</label>
                            <div class="input-group">
                                <select class="form-control accountId " name="accountId">
                                    @if($accountData)
                                    <option value="{{$accountData[0]->id}}" selected >{{$accountData[0]->name}}</option>
                                    @endif
                                </select>
                                <div class="input-group-append">
                                    <a href="{{ route('master.accounts.create') }}"
                                        class="input-group-texts btn btn-primary"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Contact Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="jobStatus">Job Title</label>
                            <input type="text" name="jobStatus" id="jobStatus" class="form-control input-lg" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" cols="20" rows="5" class="form-control"
                                required></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">E-mail</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="postalCode">Postal Code</label>
                            <input type="text" class="form-control" id="postalCode" name="postalCode" required>
                            <input type="text" class="form-control" id="form" name="form" value="{{$form}}" hidden required>
                            <input type="text" class="form-control" id="type" name="type" value="{{$type ?? ''}}" hidden required>
                            {{-- <input type="text" class="form-control" id="postalCode" name="postalCode" required> --}}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<br />
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('.accountId').select2({
            //theme: "bootstrap",
            width: null,
            placeholder: 'Account Name...',
            ajax: {
            url: '{{url("")}}/master/accounts/fetch',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                results:  $.map(data, function (item) {
                    return {
                    text: item.name,
                    id: item.id
                    }
                })
                };
            },
            cache: true
            }
        });

        $(".select2.select2-container.select2-container--default").addClass("form-control input-group-preppend");
        $(".select2-container--default .select2-selection--single").css("border", "0");
    });
</script>
@endsection
