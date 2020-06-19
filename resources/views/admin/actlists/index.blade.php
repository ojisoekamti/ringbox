@extends('layouts.app')
@section('title', 'Activity List')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
    </div>

    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Appointment</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count['countApp']}}</div>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-primary btn-circle appointment">
                                <i class="fa fa-calendar-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">E-mail</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count['countEm']}}</div>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-primary btn-circle email">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Phone</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$count['countPh']}}</div>
                                </div>
                                <div class="col">
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-primary btn-circle phone">
                                <i class="fas fa-phone"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <input type="text" value="" id="type" hidden>
    <hr>
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-lg-9">
                    {{-- <div class="form-group">
            <form class="form-inline">
              <select class="form-control" id="exampleFormControlSelect1">
                  <option>Sort By</option>
                  <option>Account</option>
                  <option>Contact Person</option>
                  <option>Progress</option>
                  <option>Date</option>
              </select>
            </form>
          </div> --}}
                </div>
                <div class="col-lg-3 text-right">
                    <div class="md-form mt-0">
                        <input class="form-control " type="text" placeholder="Search" name="search" id="search"
                            aria-label="Search">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="actlist-data">
        @include('admin.actlists.data')
    </div>

</div>
@endsection

@section('script')

<script>
    $(document).ready(function(){
    $(document).on('click','.pagination a', function(evet){
      event.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      var query = $('#search').val();
      var type = $('#type').val();
      fetch_data(page,query,type);
    });
    $( ".appointment" ).click(function() {
        $('#type').val(1)
        var page = $(this).attr('href').split('page=')[1];
        var query = $('#search').val();
        var type = $('#type').val();
        fetch_data(1,query,type);
        // alert( "Handler for .click() called." );
    });
    $( ".email" ).click(function() {
        $('#type').val(2)
        var page = $(this).attr('href').split('page=')[1];
        var query = $('#search').val();
        var type = $('#type').val();
        fetch_data(1,query,type);
        // alert( "Handler for .click() called." );
    });
    $( ".phone" ).click(function() {
        $('#type').val(3)
        var page = $(this).attr('href').split('page=')[1];
        var query = $('#search').val();
        var type = $('#type').val();
        fetch_data(1,query,type);
        // alert( "Handler for .click() called." );
    });
    $(document).on('keyup','#search',function(){
      var query = $(this).val();
      var type = $('#type').val();
      fetch_data(1,query,type);
    });
    function fetch_data(page,query,type){
      $.ajax({
        url:"{{url('')}}/admin/actlists/data?page="+page+"&query="+query+"&type="+type,
        success:function(data){
          $('#actlist-data').html(data);
        }
      })
    }
  });
</script>
@endsection
