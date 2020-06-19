@extends('layouts.app')
@section('title', 'Contact Update')
@section('content')
<!-- Begin Page Content -->
<div class="container ">
    <div class="card">
        <div class="card-header">
            @yield('title')
        </div>
        <div class="card-body">

            <form action="{{ route('master.contactPersons.update',$contactPerson->id) }}" method="post">
                @method('patch')
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="contactPersonId">Contact Id</label>
                            <input type="text" class="form-control" id="contactPersonId" name="contactPersonId"
                                value="{{$contactPerson->contactPersonId}}" disabled>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="accountId">Account Name</label>
                            <div class="input-group">
                                <select class="form-control accountId " name="accountId">
                                    <option value="{{$contactPerson->accountId}}">{{$acc[0]->name}}</option>
                                </select>
                                <div class="input-group-append">
                                    <a href="" class="input-group-texts btn btn-primary"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Contact Name</label>
                            <input type="text" class="form-control" id="name" name="name"  value="{{$contactPerson->name}}"required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="jobStatus">Job Status</label>
                            <input type="text" name="jobStatus" id="jobStatus" value="{{$contactPerson->jobStatus}}" class="form-control input-lg" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" cols="20" rows="5" class="form-control"
                                required>{{$contactPerson->address}}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" value="{{$contactPerson->city}}" name="city" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" value="{{$contactPerson->phone}}" name="phone" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">E-mail</label>
                            <input type="text" class="form-control" id="email" value="{{$contactPerson->email}}" name="email" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="postalCode">Postal Code</label>
                            <input type="text" class="form-control" id="postalCode" value="{{$contactPerson->postalCode}}" name="postalCode" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
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
    //  $('#accountId').keyup(function(){
    //         var query = $(this).val();
    //         if(query != '')
    //         {
    //          var _token = $('input[name="_token"]').val();
    //          $.ajax({
    //           url:"{{url('')}}/master/accounts/fetch?query="+query,
    //         //   method:"POST",
    //         //   data:{query:query, _token:_token},
    //           success:function(data){
    //            $('#accountList').fadeIn();
    //                     $('#accountList').html(data);
    //           }
    //          });
    //         }
    //     });

        // $(document).on('click', 'li', function(){
        //     $('#accountId').val($(this).text());
        //     $('#accountList').fadeOut();
        // });
        $(".select2.select2-container.select2-container--default").addClass("form-control input-group-preppend");
        $(".select2-container--default .select2-selection--single").css("border", "0");

    });
</script>
@endsection
