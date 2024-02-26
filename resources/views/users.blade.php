@extends('layouts.app')


    <style>


#users-table {
  width: 1626px !important;
  float: left;
}

#users-table_filter {
  margin-bottom: 16px;
}


table.dataTable thead .sorting::after {
  opacity: 0 !important;
  content: "\e150";
}

table.dataTable thead .sorting::before, table.dataTable thead .sorting_asc::before, table.dataTable thead .sorting_desc::before, table.dataTable thead .sorting_asc_disabled::before, table.dataTable thead .sorting_desc_disabled::before {
  right: 1em;
  content: "" !important;
}

table.dataTable tbody th, table.dataTable tbody td {
  padding: 14px !important;
}

    </style>
 
     @section('content')

      <div class="content-body">

<div class="container-fluid">


  

    {!! $dataTable->table() !!}

</div>

</div>
{!! $dataTable->scripts() !!}

@endsection
     


     


  

