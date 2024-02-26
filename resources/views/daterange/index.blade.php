<!DOCTYPE html>

<html>

<head>

    <title>Laravel Yajra Datatables Tutorial - ItSolutionStuff.com</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

  

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>

<body>

       

<div class="container">

    <h1>Laravel Datatables Date Range Filter Example - ItSolutionStuff.com</h1>

  

    <div style="margin: 20px 0px;">

        <strong>Date Filter:</strong>

        <input type="text" name="daterange" value="" />

        <button class="btn btn-success filter">Filter</button>

    </div>

  

    <table class="table table-bordered data-table" >

        <thead>

            <tr>

                <th>No</th>

                <th>Name</th>

                <th>Email</th>

                <th width="100px">Action</th>

            </tr>

        </thead>

        <tbody>

        </tbody>

    </table>

</div>

       

</body>

       

<script type="text/javascript">

  $(function () {

  

    $('input[name="daterange"]').daterangepicker({

        startDate: moment().subtract(1, 'M'),

        endDate: moment()

    });

        

    var table = $('.data-table').DataTable({

        processing: true,

        serverSide: true,

        ajax: {

            url: "{{ route('emailss.index') }}",

            data:function (d) {

                d.from_date = $('input[name="daterange"]').data('daterangepicker').startDate.format('YYYY-MM-DD');

                d.to_date = $('input[name="daterange"]').data('daterangepicker').endDate.format('YYYY-MM-DD');

            }

        },

        columns: [

            {data: 'id', name: 'id'},

            {data: 'name', name: 'name'},

            {data: 'email', name: 'email'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]

    });

  

    $(".filter").click(function(){

        table.draw();

    });

        

  });

</script>

</html>