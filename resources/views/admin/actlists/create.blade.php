@extends($layout)
@section('content')
<?php
    if($type==1){
        $title = 'Appointment';
    }elseif($type==2){
        $title = 'E-mail';
    }else{
        $title = 'Phone';
    }
?>
@section('title', 'Activity Create '.ucfirst($title))

<!-- Begin Page Content -->
<div class="container ">
    <div class="card">
        <div class="card-header">
            @yield('title')
        </div>
        <div class="card-body">

            <form action="{{ route('admin.actlists.store') }}" method="post" id="actlistForm">
                @csrf
                <div class="">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="actId">Activity Id</label>
                            <input type="text" class="form-control" id="actId" name="actId" value="{{$actId}}" disabled>
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
                                    @if ($data['accountData'])
                                    <option value="{{$data['accountData'][0]->id}}">{{$data['accountData'][0]->name}}
                                    </option>
                                    @endif
                                </select>
                                <div class="input-group-append">
                                    <a href="{{ route('master.accounts.create',['form'=>'actlist','id'=>$id??'','type'=>$type]) }}"
                                        class="input-group-texts btn btn-primary"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contactPersonId">Contact Name</label>
                            <div class="input-group">
                                <select class="form-control contactPersonId " name="contactPersonId">
                                    @if ($data['contactData'])
                                    <option value="{{$data['contactData'][0]->id}}">{{$data['contactData'][0]->name}}
                                    </option>
                                    @endif
                                </select>
                                <div class="input-group-append">
                                    <a @if($data['accountData'])
                                        href="{{ route('master.contactPersons.create',['form'=>'actlist','id'=>($id)??'','accountId'=>$data['accountData'][0]->id,'type'=>$type]) }}"
                                        @else
                                        href="#"
                                        @endif
                                        class="input-group-texts btn btn-primary" id="contactPerson"><i
                                            class="fa fa-plus"></i></a>
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
                                <input type="text" class="datepicker form-control" id="date" placeholder=" yyyy-mm-dd"
                                    name="date" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6 {{ ($type==2)?'d-none':'' }}">
                            <label for="phoneCall">Phone Call</label>
                            <input type="text" class="form-control" id="phoneCall" name="phoneCall"
                                value="{{($data['contactData'])?$data['contactData'][0]->phone:''}}" disabled>
                        </div>
                        <div class="form-group col-md-6 {{ ($type==3)?'d-none':'' }}">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="{{($data['contactData'])?$data['contactData'][0]->email:''}}" disabled>
                        </div>
                        <div class="form-group col-md-6 {{ ($type==3)?'d-none':'' }} {{ ($type==1)?'d-none':'' }}">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject">
                        </div>
                    </div>
                    <div class="form-group {{ ($type==1)?'':'d-none' }}">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control"
                            disabled>{{($data['contactData'])?$data['contactData'][0]->address:''}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="remark">Notes</label>
                        <textarea name="remark" id="remark" class="form-control"></textarea>
                    </div>
                    <div class="form-row {{ ($type==1)?'':'d-none' }}">
                        <div class="form-group col-md-2">
                            <label for="estimateTime">Estimate Time</label>
                            <input type="text" class="timepicker form-control" id="estimateTime" name="estimateTime"
                                value="00:00">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="clockIn">Clock-In</label>
                            <input type="text" class="timepicker form-control" id="clockIn" name="clockIn" value="00:00"
                                disabled>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="clockOut">Clock-Out</label>
                            <input type="text" class="timepicker form-control" name="clockOut" id="clockOut"
                                value="00:00" disabled>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="totalHours">Total Hours</label>
                            <input type="text" class="form-control" id="totalHours" name="totalHours" value="0"
                                disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" disabled value="Created">
                        <input type="text" class="form-control d-none" id="type" name="idType" hidden value="{{$type}}">
                        <input type="text" class="form-control d-none" name="form" hidden value="{{$form ?? ''}}">
                    </div>
                </div>
                <div class="card-footer">
                    <a type="button" class="btn btn-secondary" data-dismiss="modal" href="javascript:history.back()">Close</a>
                    <input type="submit" class="btn btn-primary" name="save" value="save"></input>
                    <input type="submit" class="btn btn-primary" name="save" value="submit"></input>
                </div>
            </form>
        </div>
    </div>
</div>
<br />
@endsection

@section('script')
<script>
    $(document).ready(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});


	$("#actlistForm .contactPersonId").change(function () {
		var id = $(this).val()
		$.ajax({
			type: 'GET',
			url: '/master/contactPersons/fetch_data',
			data: {
				id: id
			},
			success: function (data) {
                // $("#actlistForm #phoneCall").val(data[0].phone)
                // $("#actlistForm #email").val(data[0].email)
                // $("#actlistForm #address").val(data[0].address)
				// console.log(data[0].phone)
				// alert(data.success);
			}
		});

	});
	$('#actlistForm .accountId').select2({
		//theme: "bootstrap",
		width: null,
		placeholder: 'Account Name...',
		ajax: {
			url: '{{url("")}}/master/accounts/fetch',
			dataType: 'json',
			delay: 250,
			processResults: function (data) {
				return {
					results: $.map(data, function (item) {
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
		$('#actlistForm .contactPersonId').select2({
			//theme: "bootstrap",
			width: null,
			placeholder: 'Contact Name...',
			ajax: {
				url: '{{url("")}}/master/contactPersons/fetch?accountId=' + accountId,
				dataType: 'json',
				delay: 250,
				processResults: function (data) {
					// console.log($('.accountId').val(data))
					return {
						results: $.map(data, function (item) {
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
	$("#actlistForm .accountId").change(function () {
        var oldUrl = $('#actlistForm #contactPerson').attr("href");
        var newUrl = oldUrl+'?form=actlist&id={{$id??""}}&accountId='+$(this).val()+'&type={{$type}}';
        $('#actlistForm #contactPerson').attr("href", newUrl);
		var id = $(this).val()
		$.ajax({
			type: 'GET',
			url: '/master/accounts/fetch_data',
			data: {
				id: id
			},
			success: function (data) {
                $("#actlistForm #phoneCall").val(data[0].phone)
                $("#actlistForm #email").val(data[0].email)
                $("#actlistForm #address").val(data[0].address)
			}
		});
		contactPersonId($(this).val());
		changeStyle()

	});

	contactPersonId();
	changeStyle()

	function changeStyle() {
		$(".select2.select2-container.select2-container--default").addClass("form-control input-group-preppend");
		$(".select2-container--default .select2-selection--single").css("border", "0");
	}

});
</script>
@endsection
