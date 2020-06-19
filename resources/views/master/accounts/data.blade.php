<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Account Id</th>
            <th>Name</th>
            <th>City</th>
            <th>Phone</th>
            <th>E-mail</th>
            <th>Status</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $no = $table['showingStarted'];

        ?>
        @foreach ($data as $row)
        @if ($row->deleted_at != '')
        @continue
        @endif
        <tr>
            <td>{{$no}}</td>
            <td>{{$row->accountId}}</td>
            <td>{{$row->name}}</td>
            <td>{{$row->city}}</td>
            <td>{{$row->phone}}</td>
            <td>{{$row->email}}</td>
            <td>{{$row->status}}</td>
            <td>{{$row->type}}</td>
            <td>
                <a type="button" href="{{ route('master.accounts.edit', $row->id) }}" class="btn-sm btn btn-outline-primary"><i class="fas fa-eye"></i> </a>
                <a type="button" href="{{ route('master.accounts.destroy', $row->id) }}" class="btn-sm btn btn-outline-danger jquery-delete" data-method="delete"><i class="fas fa-trash"></i> </a>
                <meta name="csrf-token" content="{{ csrf_token() }}">
            </td>
        </tr>
        <?php $no = $no +1; ?>
        @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col-sm-6">
        <div class="dataTables_info" id="data-table_info" role="status" aria-live="polite">{{$tableInfo}}</div>
    </div>
    <div class="col-sm-6">
        {!! $data->links() !!}
    </div>
</div>
