@extends('layouts.app')
<style>
    .bt-content {
  font-size: 14px !important;
}
.btn.btn-info {
  padding: 9px !important;
}

.table tr td {
  font-weight: 400 !important;
}
.table tr td {
  font-weight: 400 !important;
}

.table tr td, .table tr th {
  border-bottom: 1px solid #eff2f7;
  vertical-align: middle;
  padding: 18px;
  font-size: 13px;
}

</style>

@section('content')
  
 <div class="content-body">
          <div class="container-fluid-max">
             <div class="card-header mb-5">
              <h4 class="card-title">Manage User Verifications</h4>
              
                            <a class="btn btn-success btn-sm" href="/users/export/">Export Users</a>

            </div>
          <div class="col-xxl-12">
       
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
        ajax: "{{ route('admin.verifications.list') }}",
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
