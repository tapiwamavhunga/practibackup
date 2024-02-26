@extends('layouts.app')
@section('content')
  
<div class="container-fluid">
    <div class="col-xxl-12 ">
        <div class="card-header mb-3">
              <h4 class="card-title pt-5">User Management</h4>
              <!-- <span data-href="/export-csv" id="export" class="btn btn-success btn-sm" onclick="exportTasks (event.target);">Export</span> -->
            </div>
    <table class="table yajra-datatable mb-5 pt-5">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Practice Number</th>
                <th>Company</th>
                <th>User ID</th>
                <th>User Is Admin</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="mb-5 pb-5"></div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.accounts.list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'practice_number', name: 'practice_number'},
            {data: 'company', name: 'company'},
            {data: 'id', name: 'id'},
            {data: 'is_admin', name: 'is_admin'},

            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
    
  });
</script>
