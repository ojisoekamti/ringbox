<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Contact Id</th>
            <th>Name</th>
            <th>Account</th>
            <th>City</th>
            <th>Phone</th>
            <th>E-mail</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $no = $table['showingStarted'];

        ?>
        @foreach ($data as $row)
        <tr>
            <td>{{$no}}</td>
            <td>{{$row->contactPersonId}}</td>
            <td>{{$row->name}}</td>
            <td>{{$row->accountsname}}</td>
            <td>{{$row->city}}</td>
            <td>{{$row->phone}}</td>
            <td>{{$row->email}}</td>
            <td>
                <a type="button" href="{{ route('master.contactPersons.edit', $row->id) }}" class="btn-sm btn btn-outline-primary"><i class="fas fa-eye"></i> </a>
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <a type="button" href="{{ route('master.contactPersons.destroy', $row->id) }}"
                    class="btn btn-outline-danger jquery-delete btn-sm" data-method="delete"><i class="fas fa-trash"></i> </a>
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
