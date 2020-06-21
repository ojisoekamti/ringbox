@extends('layouts.app')
@section('title', 'Quotation List')

@section('content')

<div class="container-fluid">
    <div class="card">
        <h5 class="card-header">
            @yield('title')
        </h5>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-10">
                    <a href="{{route('trans.quots.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add
                        Data</a>
                </div>
                <div class="col-sm-2 text-right">
                    <div class="md-form m-2">
                        <input class="form-control " type="text" placeholder="Search" name="search" id="search"
                            aria-label="Search">
                    </div>
                </div>
            </div>
            <div class="account-data">
              @include('trans.quots.data')

            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>

@endsection

@section('script')
<!-- <script>
    $(document).ready(function(){
            $('ul.pagination').addClass('justify-content-end');
          $(document).on('click','.pagination a', function(evet){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            var query = $('#search').val();
            fetch_data(page,query);
          });
          $(document).on('keyup','#search',function(){
            var query = $(this).val();
            fetch_data(1,query);
          });
          function fetch_data(page,query){
            $.ajax({
              url:"{{url('')}}/trans/leads/data?page="+page+"&query="+query,
              success:function(data){
                $('.account-data').html(data);
                $('ul.pagination').addClass('justify-content-end');
              }
            })
          }
        });

</script> -->
@endsection
