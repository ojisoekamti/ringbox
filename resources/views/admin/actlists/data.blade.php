<div class="card">
    <div class="card-body">
        <div class="d-flex bd-highlight">
            <div class="mr-auto p-2 bd-highlight">
                <p class="text-right">{{$tableinfo}}</p>
            </div>
            <div class="p-2 bd-highlight">{{ $data->links() }}</div>
        </div>

        <div class="row">

            <div class="col-lg-12">
                @foreach ($data as $actlist)

                <!-- Dropdown Card Example -->
                <div class="card mb-1">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            @if ($actlist->idType==1)
                            <i class="fas fa-calendar-alt"></i>
                            @elseif($actlist->idType==2)
                            <i class="fas fa-envelope"></i>
                            @else
                            <i class="fas fa-phone"></i>

                            @endif

                            {{ $actlist->actId }} </h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Action:</div>
                                @if ($actlist->clockIn=="00:00:00"&&$actlist->idType==1)
                                <a class="dropdown-item"
                                    href="{{route('admin.actlists.checInOut')}}?id={{$actlist->id}}">Check In</a>
                                @elseif($actlist->clockOut=="00:00:00"&&$actlist->idType==1)
                                <a class="dropdown-item"
                                    href="{{route('admin.actlists.checInOut')}}?id={{$actlist->id}}">Check Out</a>
                                @elseif(($actlist->idType==3||$actlist->idType==2)&&$actlist->status==1)
                                <a class="dropdown-item"
                                    href="{{route('admin.actlists.checInOut')}}?id={{$actlist->id}}">Submit</a>
                                @endif
                                <a class="dropdown-item" href="#">Convert</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('admin.actlists.edit',$actlist->id)}}">Detail</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-4">
                                <p class="text-sm"><i class="fas fa-user"></i> Account : {{ $actlist->name }}</p>
                                <p class="text-sm"><i class="fas fa-user"></i> Date :
                                    {{ date('d-m-Y',strtotime($actlist->date)) }}</p>
                                @if ($actlist->idType==1)
                                <p class="text-sm"><i class="fa fa-tasks"></i> Status :
                                    @if ($actlist->clockIn==='00:00:00')
                                    Created
                                    @elseif(strtotime($actlist->clockOut)>strtotime('00:00:00'))
                                    Compelete
                                    @elseif($actlist->clockIn!='00:00:00')
                                    In-Progress
                                    @endif
                                </p>
                                @else
                                <p class="text-sm"><i class="fa fa-tasks"></i> Status :
                                    {{$actlist->status==1? 'Draft':'Complete' }}</p>
                                @endif


                            </div>
                            <div class="col-lg-4">

                                @if ($actlist->idType==1)
                                <p class="text-sm"><i class="fa fa-file-alt "></i> Notes :
                                    {{substr($actlist->remarks,0,50)}} {{ (strlen($actlist->remarks)<50)?'':'...' }}
                                </p>
                                <p class="text-sm"><i class="fa fa-clock"></i> Estimate Time :
                                    {{ ($actlist->estimateTime=='00:00:00')? '' : date('H:i',strtotime($actlist->estimateTime)) }}
                                </p>
                                @elseif($actlist->idType==2)
                                <p class="text-sm"><i class="fa fa-clock"></i> Subject : {{ $actlist->subject ?? '' }}
                                </p>
                                @elseif($actlist->idType==3)
                                <p class="text-sm"><i class="fa fa-file-alt "></i> Notes :
                                    {{substr($actlist->remarks,0,50)}} {{ (strlen($actlist->remarks)<50)?'':'...' }}
                                </p>
                                @endif
                            </div>
                            <div class="col-lg-4">
                                @if ($actlist->idType==1)
                                <?php $clockIn=strtotime($actlist->clockIn);$clockOut=strtotime($actlist->clockOut); ?>
                                <p class="text-sm"><i class="fa fa-user-clock"></i> Clock In :
                                    {{ $actlist->clockIn==='00:00:00' ? '-': date('H:i',$clockIn) }}</p>
                                <p class="text-sm"><i class="fa fa-business-time"></i> Clock Out :
                                    {{ $actlist->clockOut==='00:00:00' ? '-' : date('H:i',$clockOut) }}</p>
                                <p class="text-sm"><i class="fa fa-clock"></i> Total Hours :
                                    <?php $totalHours = ($clockOut-$clockIn)/60 ?>
                                    {{ $actlist->clockOut==='00:00:00' ? '-' : sprintf("%02d:%02d", floor($totalHours/60), $totalHours%60) }}
                                </p>
                                @endif

                            </div>
                        </div>
                    </div>

                </div>

                @endforeach

            </div>

        </div>
    </div>
</div>
