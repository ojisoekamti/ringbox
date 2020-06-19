@extends('layouts.app')
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
@section('title', ucfirst($title).' Activity')

<!-- Begin Page Content -->
<div class="container ">
    <div class="card">
        <div class="card-header">
            @yield('title')
        </div>
        <div class="card-body">
            <div class="detail">
                <div class="row pb-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">Activity Id</div>
                    <div class="col-lg-6">: {{$actId}}</div>
                </div>
                <div class="row pb-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">Sales Id</div>
                    <div class="col-lg-6">: ADMIN-{{$user->id ?? ''}}</div>
                </div>
                <div class="row pb-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">Sales Name</div>
                    <div class="col-lg-6">: {{$user->name ?? ''}}</div>
                </div>
                <div class="row pb-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">Account Name</div>
                    <div class="col-lg-6">: {{$data['accountData'][0]->name}}</div>
                </div>
                <div class="row pb-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">Contact Name</div>
                    <div class="col-lg-6">: {{$data['contactData'][0]->name}}</div>
                </div>
                <div class="row pb-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">Date</div>
                    <div class="col-lg-6">: {{date("d-m-Y",strtotime($actlist->date))}}</div>
                </div>
                @if($actlist->idType!=3)
                <div class="row pb-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">E-mail</div>
                    <div class="col-lg-6">: {{$data['accountData'][0]->email}}</div>
                </div>
                @endif
                @if($actlist->idType!=2)
                <div class="row pb-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">Phone</div>
                    <div class="col-lg-6">: {{$data['accountData'][0]->phone}}</div>
                </div>
                @endif
                @if($actlist->idType==2)
                <div class="row pb-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">Subject</div>
                    <div class="col-lg-6">: {{$actlist->subject}}</div>
                </div>
                @endif
                <div class="row pb-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">Notes</div>
                    <div class="col-lg-6 text-justify">: {{$actlist->remarks}}</div>
                </div>
                @if($actlist->idType==1)
                <div class="row pb-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">Address</div>
                    <div class="col-lg-6">: {{$data['accountData'][0]->address}}</div>
                </div>
                <div class="row pb-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">Estimate Time</div>
                    <div class="col-lg-6">: {{date('H:i',strtotime($actlist->estimateTime))}}</div>
                </div>
                <div class="row pb-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">Check In</div>
                    <div class="col-lg-6">:
                        {{date('H:i',strtotime(($actlist->clockIn=='00:00:00'?'00:00:00':$actlist->clockIn)))}}</div>
                </div>
                <div class="row pb-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">Check Out</div>
                    <div class="col-lg-6">:
                        {{date('H:i',strtotime(($actlist->clockOut=='00:00:00')?'00:00:00':$actlist->clockOut))}}</div>
                </div>
                <div class="row pb-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">Total Hours</div>
                    <div class="col-lg-6">:
                        <?php $totalHours = (strtotime($actlist->clockOut)-strtotime($actlist->clockIn))/60 ?>
                        {{ $actlist->clockOut==='00:00:00' ? '-' : sprintf("%02d:%02d", floor($totalHours/60), $totalHours%60) }}
                    </div>
                </div>
                @endif
                <div class="row pb-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">Status</div>
                    <div class="col-lg-6">:
                        <?php $status = '' ?>

                        @if($actlist->idType==1)
                        @if ($actlist->clockIn==='00:00:00')
                        Created
                        @elseif(strtotime($actlist->clockOut)>strtotime('00:00:00'))
                        Compelete
                        <?php $status = 2 ?>
                        @elseif($actlist->clockIn!='00:00:00')
                        In-Progress
                        @endif
                        @else
                        @if($actlist->status==1)
                        Draft
                        @else
                        Compelete
                        <?php $status = 2 ?>
                        @endif
                        @endif

                    </div>
                </div>
                <hr>
                <a type="button" class="btn btn-secondary" data-dismiss="modal"
                    href="javascript:history.back()">Close</a>
                @if($status!=2)
                <button class="editDetail btn btn-primary">Edit</button>
                <a class="btn btn-primary" href="{{route('admin.actlists.checInOut')}}?id={{$actlist->id}}">
                    @if($actlist->idType==1&&$actlist->clockIn==='00:00:00')
                    Check In
                    @elseif($actlist->idType==1&&$actlist->clockIn!='00:00:00')
                    Check Out
                    @else
                    Submit
                    @endif
                </a>
                @endif
            </div>
            <form action="{{ route('admin.actlists.store') }}" method="post" class="editForm" style="display:none">
                @csrf
                <div class="modal-body">
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
                                        @else href="#" @endif class="input-group-texts btn btn-primary"
                                        id="contactPerson"><i class="fa fa-plus"></i></a>
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
                                    name="date" autocomplete="off" value="{{date("Y-m-d",strtotime($actlist->date))}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6 {{ ($type==2)?'d-none':'' }}">
                            <label for="phoneCall">Phone Call</label>
                            <input type="text" class="form-control" id="phoneCall" name="phoneCall"
                                value="{{($data['accountData'])?$data['accountData'][0]->phone:''}}" disabled>
                        </div>
                        <div class="form-group col-md-6 {{ ($type==3)?'d-none':'' }}">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="{{($data['accountData'])?$data['accountData'][0]->email:''}}" disabled>
                        </div>
                        <div class="form-group col-md-6 {{ ($type==3)?'d-none':'' }} {{ ($type==1)?'d-none':'' }}">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject"
                                value="{{$actlist->subject}}">
                        </div>
                    </div>
                    <div class="form-group {{ ($type==1)?'':'d-none' }}">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control"
                            disabled>{{($data['accountData'])?$data['accountData'][0]->address:''}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="remark">Notes</label>
                        <textarea name="remark" id="remark" class="form-control">{{$actlist->remarks}}</textarea>
                    </div>
                    <div class="form-row {{ ($type==1)?'':'d-none' }}">
                        <div class="form-group col-md-2">
                            <label for="estimateTime">Estimate Time</label>
                            <input type="text" class="timepicker form-control" id="estimateTime" name="estimateTime"
                                value="{{$actlist->estimateTime}}">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="clockIn">Clock-In</label>
                            <input type="text" class="timepicker form-control" id="clockInText" name="clockInText"
                                value="{{$actlist->clockIn}}" disabled>
                            <input type="text" class="timepicker form-control" id="clockIn" name="clockIn"
                                value="{{$actlist->clockIn}}" hidden>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="clockOut">Clock-Out</label>
                            <input type="text" class="timepicker form-control" name="clockOut" id="clockOut"
                                value="{{$actlist->clockOut}}" disabled>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="totalHours">Total Hours</label>
                            <input type="text" class="form-control" id="totalHours" name="totalHours" value="0"
                                disabled>
                        </div>
                    </div>

                    <?php $status = '' ?>

                    @if($actlist->idType==1)
                    @if ($actlist->clockIn==='00:00:00')
                    <?php $statusText = "Created" ?>
                    @elseif(strtotime($actlist->clockOut)>strtotime('00:00:00'))
                     <?php $statusText = "Compelete" ?>
                    <?php $status = 2 ?>
                    @elseif($actlist->clockIn!='00:00:00')
                    <?php $statusText = "In-Progress" ?>
                    @endif
                    @else
                    @if($actlist->status==1)
                     <?php $statusText = "Draft" ?>
                    @else
                     <?php $statusText = "Compelete" ?>
                    <?php $status = 2 ?>
                    @endif
                    @endif
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" disabled value="{{$statusText}}" >
                        <input type="text" class="form-control" id="status" name="status" disabled value="{{$status}}" hidden>
                        <input type="text" class="form-control d-none" id="type" name="idType" hidden value="{{$type}}">
                    </div>
                </div>
                <div class="card-footer">
                    <a type="button" class="btn btn-secondary" data-dismiss="modal"
                        href="javascript:history.back()">Close</a>
                    <input type="submit" class="btn btn-primary" name="save" value="save"></input>
                    @if($type!=1)
                    <input type="submit" class="btn btn-primary" name="save" value="submit"></input>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
<br />
@endsection

@section('script')
<script>
    $(".editDetail").click(function(){
        $(".detail").fadeToggle("slow",function(){
            $(".editForm").fadeToggle("slow");
        });

        // $("#div3").fadeOut(3000);
    });
    $(document).ready(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});


	$(".contactPersonId").change(function () {
		var id = $(this).val()
		$.ajax({
			type: 'GET',
			url: '/master/contactPersons/fetch_data',
			data: {
				id: id
			},
			success: function (data) {
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
		$('.contactPersonId').select2({
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
	$(".accountId").change(function () {
        var oldUrl = $('#contactPerson').attr("href");
        var newUrl = oldUrl+'?form=actlist&id={{$id??""}}&accountId='+$(this).val()+'&type={{$type}}';
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

});
</script>
@endsection
