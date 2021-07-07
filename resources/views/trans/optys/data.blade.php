
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Id</th>
            <th>Account</th>
            <th>Contact</th>
            <th>Score</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php
        // dd($tableInfo);
        // $no = $table['showingStarted'];
          if ($data ?? ''??''){
        ?>
        @foreach ($data ?? '' as $row)
        <tr>
            <td>{{$no}}</td>
            <td>{{$row->leadsId}}</td>
            <td>{{$row->account}}</td>
            <td>{{$row->contact}}</td>
            <td>{{$row->score}}</td>
            <td>{{$row->status}}</td>
            <td>
                <a type="button" href="{{ route('master.accounts.edit', $row->id) }}" class="btn-sm btn btn-outline-primary"><i class="fas fa-eye"></i> </a>
                <a type="button" href="{{ route('master.accounts.destroy', $row->id) }}" class="btn-sm btn btn-outline-danger jquery-delete" data-method="delete"><i class="fas fa-trash"></i> </a>
                <meta name="csrf-token" content="{{ csrf_token() }}">
            </td>
        </tr>
        <?php $no = $no +1; ?>
        @endforeach
      <?php }?>
    </tbody>
</table>

<div class="row">
    <div class="col-sm-6">
        <div class="dataTables_info" id="data-table_info" role="status" aria-live="polite"></div>
    </div>
    <div class="col-sm-6">
        
    </div>
</div>
