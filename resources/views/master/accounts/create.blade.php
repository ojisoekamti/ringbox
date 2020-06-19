@extends($layout)
@section('title', 'Account Create')
@section('content')
<!-- Begin Page Content -->
<div class="container ">
    <div class="card">
        <div class="card-header">
            @yield('title')
        </div>
        <div class="card-body">

            <form action="{{ route('master.accounts.store') }}" method="post" id="formAct">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="accountId">Account Id</label>
                            <input type="text" class="form-control" id="accountId" name="accountId" value="{{$accountId}}" disabled>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="name">Account Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" cols="20" rows="5" class="form-control" required></textarea>
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
                        </div>
                        <div class="form-group col-md-4 d-none">
                            <label for="form">actlist</label>
                            <input type="text" class="form-control" id="form" name="form" value="{{$form}}">
                            <input type="text" class="form-control" id="type" name="type" value="{{$type}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="idStatusAccount">Status Account</label>
                            <select class="custom-select" name="idStatusAccount">
                                <option selected>Select Status</option>
                                <option value="1">Prospect</option>
                                <option value="2">Fix</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="idStatusAccount">Type Account</label>
                            <select class="custom-select" name="idType">
                                <option selected>Select Type</option>
                                <option value="1">Corporate</option>
                                <option value="2">Personal</option>
                            </select>
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

{{-- <script>
    $("#submit").click(function(e) {
        e.preventDefault();
        var _token = $("input[name='_token']").val();
        var name = $("input[name='name']").val();
        var address = $("textarea[name='address']").val();
        var city = $("input[name='city']").val();
        var phone = $("input[name='phone']").val();
        var email = $("input[name='email']").val();
        var postalCode = $("input[name='postalCode']").val();
        var idStatusAccount = $("select[name='idStatusAccount']").val();
        var idType = $("select[name='idType']").val();
        var form = $("input[name='form']").val();
        var data = {
            _token: _token,
            name: name,
            address: address,
            city: city,
            phone: phone,
            email: email,
            postalCode: postalCode,
            form: form,
        }
        if (form == 'modal') {
            $("#formAct").removeAttr("action");
            $.ajax({
                url: "{{ route('master.accounts.store') }}",
                type: 'POST',
                data: data,
                success: function(data) {
                    console.log(data)
                }
            });
        }

    });
</script> --}}
@endsection
