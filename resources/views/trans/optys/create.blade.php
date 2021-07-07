@extends('layouts.app')
@section('title', 'Create Opportunity ')
@section('content')

<!-- Begin Page Content -->


<nav class="navbar navbar-light bg-white">
    <ul class="nav nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                aria-controls="pills-home" aria-selected="true">General Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                aria-controls="pills-profile" aria-selected="false">Activity List</a>
        </li>
    </ul>
</nav>


<div class="container-fluid bg-white p-3 ">
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.actlists.store') }}" method="post" class="leadsForm">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-md-3">
                              <label for="leadsId">Opportunity Id</label>
                              <input type="text" class="form-control" id="leadsId" name="leadsId" value="{{$leadsId ?? ''}}"
                                  >
                          </div>
                          <div class="form-group col-md-3">
                              <label for="leadsId">Lead Id</label>
                              <input type="text" class="form-control" id="leadsId" name="leadsId" value="{{$leadsId ?? ''}}"
                                  disabled>
                                </div>
                            <div class="form-group col-md-3">
                                <label for="idSales">Sales Id</label>
                                <input type="text" class="form-control" id="idSales" name="idSales"
                                    value="ADMIN-{{$user->id ?? ''}}" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="salesName">Sales Name</label>
                                <input type="text" class="form-control" id="salesName" name="salesName"
                                    value="{{$user->name ?? ''}}" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="accountId">Account Name</label>
                                <div class="input-group">
                                    <select class="form-control accountId " name="accountId">

                                    </select>
                                    <div class="input-group-append">
                                        <a href="{{ route('master.accounts.create',['form'=>'modal','id'=>$id??'']) }}"
                                            class="input-group-texts btn btn-primary createAccount" data-toggle="modal"
                                            data-target="#MyModal" id="MyModalBtn"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contactPersonId">Contact Name</label>
                                <div class="input-group">
                                    <select class="form-control contactPersonId " name="contactPersonId">

                                    </select>
                                    <div class="input-group-append">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date">Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <input type="text" class="datepicker form-control" id="date"
                                        placeholder=" yyyy-mm-dd" name="date" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 ">
                                <label for="phoneCall">Phone Call</label>
                                <input type="text" class="form-control" id="phoneCall" name="phoneCall"
                                     disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                     disabled>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class="form-control"
                                disabled></textarea>
                        </div>
                        <div class="form-group">
                            <label for="expValue">Expected Value</label>
                            <input type="text" class="form-control" id="expValue" name="expValue"
                                 >
                        </div>
                        <div class="form-group">
                            <label for="description">Notes</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="scoreId">Status</label>
                            <select class="form-control" name="scoreId" id="scoreId">
                                <option value="">Select Score</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="scoreId">Phase</label>
                            <select class="form-control" name="scoreId" id="scoreId">
                                <option value="">Identify Opportunity</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="score">Score</label>
                            <input type="text" class="form-control" id="score" name="score" disabled>
                        </div>

                        <a type="button" class="btn btn-secondary" data-dismiss="modal"
                            href="javascript:history.back()">Close</a>
                        <input type="submit" class="btn btn-primary " name="save" value="save"></input>
                        <input type="submit" class="btn btn-primary " name="save" value="submit"></input>

                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show " id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="card">
                <div class="card-body">
                    <div class="table">
                        <div class="row">
                            <div class="col-sm-10 pb-2">
                                <a href="#" class="btn btn-outline-primary addActivity" data-toggle="modal"
                                    data-target="#MyModal" id="MyModalBtn"><i class="fa fa-plus"></i> Add Activity</a>
                            </div>
                            <div class="col-sm-2 text-right">
                                {{-- <div class="md-form ">
                                    <input class="form-control " type="text" placeholder="Search" name="search"
                                        id="search" aria-label="Search">
                                </div> --}}
                            </div>
                        </div>
                        <table class="table data-table" id="" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>Activity Id</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<br />

<div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">


            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<!-- <script>
    $('nav.navbar.navbar-expand.navbar-light.bg-white.topbar.mb-4.static-top.shadow').addClass('mb-1').removeClass('mb-4');


    $(document).ready(function() {
        $('.createAccount').on('click', function(e) {
            e.preventDefault();
            // $('#MyModal').modal('show')
            $('#MyModal').find('.modal-body').fadeOut("slow").load($(this).attr('href'), function() {
                $(".contentAct").hide();
                $('#submit').click(function(e) {
                    e.preventDefault();

                    var _token = $("input[name='_token']").val();
                    var name = $("input[name='name']").val();
                    var address = $("#formAct textarea[name='address']").val();
                    var city = $("input[name='city']").val();
                    var phone = $("input[name='phone']").val();
                    var email = $("#formAct input[name='email']").val();
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
                    $("#formAct").removeAttr("action");
                    $.ajax({
                        url: "{{ route('master.accounts.store') }}",
                        type: 'POST',
                        data: data,
                        success: function(data) {
                            $("select[name='accountId']").append(new Option(data.name, data.id))
                            // console.log(data)
                        }
                    });
                    // console.log(data)
                    $('#MyModal').modal('toggle')
                })
            }).fadeIn('slow');

        })

        $('.createContact').on('click', function(e) {
            // console.log($('.accountId').val())

            e.preventDefault();
            $('#MyModal').modal('show')
            if ($('.accountId').val()) {
                $('#MyModal').find('.modal-body').fadeOut("slow").load('{{url("")}}/master/contactPersons/create?form=modal&id={{$id??""}}&accountId=' + $('.accountId').val(), function() {
                    $(".contentAct").hide();
                    // console.log('testmodal')
                    $('#submit').click(function(e) {
                        e.preventDefault();

                        var _token = $("input[name='_token']").val();
                        var accountId = $("input[name='accountId']").val();
                        var name = $("#formAct input[name='name']").val();
                        var address = $("#formAct textarea[name='address']").val();
                        var city = $("input[name='city']").val();
                        var phone = $("#formAct input[name='phone']").val();
                        var email = $("#formAct input[name='email']").val();
                        var postalCode = $("#formAct input[name='postalCode']").val();
                        var jobStatus = $("#formAct input[name='jobStatus']").val();
                        var form = $("input[name='form']").val();
                        var type = $("#formAct input[name='type']").val();
                        var data = {
                            _token: _token,
                            accountId: accountId,
                            name: name,
                            address: address,
                            city: city,
                            phone: phone,
                            email: email,
                            postalCode: postalCode,
                            jobStatus: jobStatus,
                            type: type,
                            form: form,
                        }
                        $("#formAct").removeAttr("action");
                        $.ajax({
                            url: "{{ route('master.contactPersons.store') }}",
                            type: 'POST',
                            data: data,
                            success: function(data) {
                                $("select[name='contactPersonId']").append(new Option(data.name, data.id))
                                $(".leadsForm input[name='phoneCall']").val(data.phone)
                                $(".leadsForm input[name='email']").val(data.email)
                                $(".leadsForm textarea[name='address']").val(data.address)

                                // console.log(data)
                            }
                        });
                        // console.log(data)
                        $('#MyModal').modal('toggle')
                    })
                }).fadeIn('slow');
            } else {
                $(".contentAct").hide();
                $('#MyModal').find('.modal-body').html('PLease Select Account')
            }


        })

        $('.addActivity').on('click', function(e) {

            if ($('.accountId').val()) {
                var html = '<div class="form-row contentAct "> <div class="col-md-8 align-self-center m-2 form-row"><label>PLease Select Action</label> <select name="contentAct" id="contentAct" class="form-control"> <option value="">Please Choise</option><option value="1">Appoinment Activity</option> <option value="2">E-mail Activity</option> <option value="3">Phone Activity</option> <option value="4">Existing Activity</option> </select></div></div>'
                $('#MyModal').find('.modal-header').html(html, function(e) {
                    e.preventDefault()
                })
                $('#MyModal').find('.modal-body').html('', function(e) {
                    e.preventDefault()
                })
                $('select[name="contentAct"]').on('change', function() {
                    var val = $(this).val()
                    var url = ''
                    if (val == 1) {
                        url = "{{route('admin.actlists.create')}}?form=modal&type=1"
                    } else if (val == 2) {
                        url = "{{route('admin.actlists.create')}}?form=modal&type=2"
                    } else if (val == 3) {
                        url = "{{route('admin.actlists.create')}}?form=modal&type=3"
                    } else {
                        url = ''
                    }
                    // console.log(url)
                    $('#MyModal').find('.modal-body').fadeOut("slow").load(url, function() {
                        $("#actlistForm select[name='accountId']").append(new Option($('.accountId').text(), $('.accountId').val()))

                        $('.datepicker').each(function() {
                            $(this).datepicker({
                                autoclose: true,
                                format: 'yyyy-mm-dd',
                                startDate: new Date()
                            });
                        });

                        $('.timepicker').each(function() {
                            $(this).timepicker({
                                minuteStep: 1,
                                showSeconds: false,
                                showMeridian: false,
                                defaultTime: false
                            });
                        });


                    }).fadeIn('slow', function() {
                        contactPersonId($('.accountId').val())
                        changeStyle()
                        $('#actlistForm input[name="save"]').click(function(e) {
                            e.preventDefault()
                            // var idSales = $('input[name="idSales"').val()
                            var _token = $("#actlistForm input[name='_token']").val();
                            var accountId = $('#actlistForm select[name="accountId"]').val()
                            var accountId = $('#actlistForm select[name="accountId"]').val()
                            var contactPersonId = $('#actlistForm select[name="contactPersonId"]').val()
                            var date = $('#actlistForm input[name="date"]').val()
                            var subject = $('#actlistForm input[name="subject"]').val()
                            // var phone = $('input[name="subject"').val()
                            var remarks = $('#actlistForm textarea[name="remark"]').val()
                            var estimateTime = $('#actlistForm input[name="estimateTime"]').val()
                            var clockIn = $('#actlistForm input[name="clockIn"]').val()
                            var clockOut = $('#actlistForm input[name="clockOut"]').val()
                            var idType = $('#actlistForm input[name="idType"]').val()
                            var leadId = $('#actlistForm input[name="leadId"]').val()
                            var form = $('#actlistForm input[name="form"]').val()
                            var tempLeadId = '{{$leadsId ?? ''}}'
                            var save = $(this).attr("value")
                            var data = {
                                _token: _token,
                                accountId: accountId,
                                contactPersonId: contactPersonId,
                                date: date,
                                subject: subject,
                                remark: remarks,
                                estimateTime: estimateTime,
                                clockIn: clockIn,
                                clockOut: clockOut,
                                idType: idType,
                                leadId: leadId,
                                form: form,
                                tempLeadId: tempLeadId,
                                save: save
                            }
                            $.ajax({
                                url: "{{ route('admin.actlists.store') }}",
                                type: 'POST',
                                data: data,
                                success: function(data) {
                                    var typeName = ''
                                    var status = ''
                                    if (data.idType == "1") {
                                        typeName = 'Appointment'
                                        if (data.clockIn == '0:00') {
                                            status = "Created"
                                        } else if (data.clockIn != '0:00' && data.clockOut == '0:00') {
                                            status = "In-Progress"
                                        } else {
                                            status = "Complete"
                                        }
                                    } else if (data.idType == "2") {
                                        typeName = 'E-Mail'
                                        if (data.status == 1) {
                                            status = "Draft"
                                        } else {
                                            status = "Complete"
                                        }
                                    } else {
                                        typeName = 'Phone'
                                        if (data.status == 1) {
                                            status = "Draft"
                                        } else {
                                            status = "Complete"
                                        }
                                    }
                                    var table = $('#example').DataTable();

                                    $(".odd").hide()
                                    var action = '<a href="" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a> ' +
                                        '<a href="" class="btn btn-outline-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Submit Progress"><i class="fa fa-check-square"></i></a> ' +
                                        '<a href="" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>'
                                    var t = $('.data-table').DataTable()
                                    t.row.add([
                                        data.actId,
                                        typeName,
                                        data.date,
                                        data.remarks,
                                        status,
                                        action
                                    ]).draw(false);

                                    $('#MyModal').modal('toggle')
                                }
                            });
                            console.log(data)
                        })
                    })
                })
            } else {
                $(".contentAct").hide();
                $('#MyModal').find('.modal-body').html('PLease Select Account')
            }
        })

        function fetchAct() {
            $('.data-table').DataTable({
                ajax: {
                    url: 'http://127.0.0.1:8000/admin/actlists/fetchActlist?leadsId=LEAD0003'
                },
                columns: [{
                        data: 'actId',
                        name: 'actId'
                    },
                    {
                        data: 'idType',
                        name: 'idType'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'remarks',
                        name: 'remarks'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                ]

            })
        }
        $('#submit').submit(function(e) {
            e.preventDefault();
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $("#scoreId").change(function() {
            var vid = $(this).val();
            $.ajax({
                url: '{{url("")}}/master/leadsScores/getScore',
                type: "Get",
                dataType: 'json',
                data: {
                    id: vid
                },
                success: function(data) {
                    $("#score").val(data[0].score);
                }
            });

        })
        $(".contactPersonId").change(function() {
            var id = $(this).val()
            $.ajax({
                type: 'GET',
                url: '/master/contactPersons/fetch_data',
                data: {
                    id: id
                },
                success: function(data) {
                    $("#phoneCall").val(data[0].phone)
                    $("#email").val(data[0].email)
                    $("#address").val(data[0].address)
                    console.log(data[0].phone)
                    // alert(data.success);
                }
            });

        });
        $('.accountId').select2({
            //theme: "bootstrap",
            width: null,
            placeholder: 'Account Name...',
            ajax: {
                url: '{{url("")}}/master/accounts/fetch',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
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

        function contactPersonId(accountId) {
            $('.contactPersonId').select2({
                //theme: "bootstrap",
                width: null,
                placeholder: 'Contact Name...',
                ajax: {
                    url: '{{url("")}}/master/contactPersons/fetch?accountId=' + accountId,
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        // console.log($('.accountId').val(data))
                        return {
                            results: $.map(data, function(item) {
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
        }
        $(".accountId").change(function() {
            var oldUrl = $('#contactPerson').attr("href");
            var newUrl = oldUrl + '?form=modal&id={{$id??""}}&accountId=' + $(this).val();
            $('#contactPerson').attr("href", newUrl);
            contactPersonId($(this).val());
            changeStyle()

        });

        contactPersonId();
        changeStyle()

        function changeStyle() {
            $(".select2.select2-container.select2-container--default").addClass("form-control input-group-preppend");
            $(".select2-container--default .select2-selection--single").css("border", "0");
        }

    }); -->
</script>
@endsection
