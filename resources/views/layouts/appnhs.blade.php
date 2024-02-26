<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Medinformer Practitioner Portal</title>

<!-- Scripts -->
<script type='text/javascript' id='medinformer-api-client-js-extra'>
/* <![CDATA[ */
    var ajax = {"url":"https:\/\/practitioner.medinformer.co.za\/ajax.php"};
/* ]]&gt; */
</script>
<!-- Fonts -->

<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet"> 
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">

<style type="text/css">
    
    @font-face {
font-family: 'Glyphicons Halflings';
src: url('https://netdna.bootstrapcdn.com/bootstrap/3.0.0/fonts/glyphicons-halflings-regular.eot');  src: url('https://netdna.bootstrapcdn.com/bootstrap/3.0.0/fonts/glyphicons-halflings-regular.eot?#iefix') format('embedded-opentype'), url('https://netdna.bootstrapcdn.com/bootstrap/3.0.0/fonts/glyphicons-halflings-regular.woff') format('woff'), url('https://netdna.bootstrapcdn.com/bootstrap/3.0.0/fonts/glyphicons-halflings-regular.ttf') format('truetype'), url('https://netdna.bootstrapcdn.com/bootstrap/3.0.0/fonts/glyphicons-halflings-regular.svg#glyphicons-halflingsregular') format('svg');



}
    .dropdown-menu {
  font-size: 12px !important;
  color: #7184ad;
  text-align: left;
  list-style: none;
}

  @media only screen and (max-width: 767px){
    .header.bg-light {
  left: 0px !important;
  right: 0px !important;
}

.content-body {
  margin-left: 0px !important;
  margin-right: 0px !important;
}

  }

#main-wrapper {
  opacity: 1 !important;
  -webkit-transition: all 0.25s ease-in;
  transition: all 0.25s ease-in;
  overflow: hidden;
  position: relative;
  z-index: 1;
  margin-top: 80px;
}


</style>



@include('templates.override')
</head>

<style type="text/css">
    .brochure_whatsapp_button {
  border: 0;
background-color: #54BE91;
color: #fff;
line-height: 36px;
padding: 0 15px;
font-size: 12px;
text-transform: uppercase;
font-weight: bold;
letter-spacing: 0.5px;
vertical-align: middle;
border-radius: 3px;
height: 36px;
opacity: 1;
text-shadow: 1px 1px 1px rgba(0,0,0,0.24);
}

#alphabetical-posts .posts .item a:hover {
  text-decoration: none;
  font-size: 14px;
  font-family: 'Archivo', sans-serif;
  color: #1f2c73 !important;
}

@media only screen and (max-width: 600px) {
  .listing-group-filter-label{
    font-weight: 600;
    line-height: 21px !important;
    padding-right: 10px !important;
}
}


.iti__flag.iti__ca {
  display: none;
}


.iti__flag.iti__gb {
  display: none;
}


.iti__flag-box {
  display: none;
}

</style>

<body class="dashboard">
        <div id="main-wrapper">
            @include('templates.header')
            @include('templates.sidebar')
            <div class="content-body" style="background: #fff !important;">
                @yield('content')
            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
<script>
  var input = document.querySelector("#ec-mobile-numbers");
  window.intlTelInput(input, {
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
  });
</script>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
<script src="{{ asset('js/global/nhs/main/scriptsnhs.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>



    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

 <script>

    $(document).ready(function(){

        $('.input-daterange').datepicker({

            todayBtn:'linked',

            format:'yyyy-mm-dd',

            autoclose:true

        });


        load_data();


        function load_data(from_date = '', to_date = ''){

            $('#order_table').DataTable({

                processing: true,

                serverSide: true,

                ajax: {

                    url:'{{ route("user_reports.index") }}',

                    data:{from_date:from_date, to_date:to_date}

                },

                columns: [

                    {

                        data:'id',

                        name:'id'

                    },

                    {

                        data:'hids',

                        name:'hids'

                    },

                    {

                        data:'doctor_name',

                        name:'doctor_name'

                    },

                    {

                        data:'patient_email',

                        name:'patient_email'

                    },
                    {

                        data:'doctor_email',

                        name:'doctor_email'

                    },

                    {

                        data:'open',

                        name:'open'

                    },

                    {

                        data:'clicks',

                        name:'clicks'

                    },
                    {

                        data:'created_at',

                        name:'created_at'

                    }

                ]

            });

        }


        $('#filter').click(function(){

            var from_date = $('#from_date').val();

            var to_date = $('#to_date').val();


            if(from_date != '' &&  to_date != ''){

                $('#order_table').DataTable().destroy();

                load_data(from_date, to_date);

            } else{

                alert('Both Date is required');

            }


        });


        $('#refresh').click(function(){

            $('#from_date').val('');

            $('#to_date').val('');

            $('#order_table').DataTable().destroy();

            load_data();

        });

    });

</script>


<script>

    $(document).ready(function(){

        $('.input-daterange').datepicker({

            todayBtn:'linked',

            format:'yyyy-mm-dd',

            autoclose:true

        });


        load_data();


        function load_data(from_date_whatsapp = '', to_date_whatsapp = ''){

            $('#whatsapp_table').DataTable({

                processing: true,

                serverSide: true,

                ajax: {

                    url:'{{ route("whatsapp") }}',

                    data:{from_date_whatsapp:from_date_whatsapp, to_date_whatsapp:to_date_whatsapp}

                },

                columns: [

                    {

                        data:'id',

                        name:'id'

                    },

                    {

                        data:'hids',

                        name:'hids'

                    },

                    {

                        data:'doctor_name',

                        name:'doctor_name'

                    },

                    {

                        data:'msidn',

                        name:'msidn'

                    },
                    {

                        data:'original_url',

                        name:'original_url'

                    },
                    
                    

                    {

                        data:'clicks',

                        name:'clicks'

                    },
                    {

                        data:'created_at',

                        name:'created_at'

                    }

                ]

            });

        }


        $('#filter_whatsapp').click(function(){

            var from_date_whatsapp = $('#from_date_whatsapp').val();

            var to_date_whatsapp = $('#to_date_whatsapp').val();


            if(from_date_whatsapp != '' &&  to_date_whatsapp != ''){

                $('#whatsapp_table').DataTable().destroy();

                load_data(from_date_whatsapp, to_date_whatsapp);

            } else{

                alert('Both Date is required');

            }


        });


        $('#refresh').click(function(){

            $('#from_date_whatsapp').val('');

            $('#to_date_whatsapp').val('');

            $('#whatsapp_table').DataTable().destroy();

            load_data();

        });

    });

</script>



<script>

    $(document).ready(function(){

        $('.input-daterange').datepicker({

            todayBtn:'linked',

            format:'yyyy-mm-dd',

            autoclose:true

        });


        load_data();


        function load_data(from_date_sms = '', to_date_sms = ''){

            $('#sms_table').DataTable({

                processing: true,

                serverSide: true,

                ajax: {

                    url:'{{ route("sms") }}',

                    data:{from_date_sms:from_date_sms, to_date_sms:to_date_sms}

                },

                columns: [

                    {

                        data:'id',

                        name:'id'

                    },

                    {

                        data:'hids',

                        name:'hids'

                    },

                    {

                        data:'doctor_name',

                        name:'doctor_name'

                    },

                    {

                        data:'msidn',

                        name:'msidn'

                    },
                    {

                        data:'original_url',

                        name:'original_url'

                    },
                    
                    

                    {

                        data:'clicks',

                        name:'clicks'

                    },
                    {

                        data:'created_at',

                        name:'created_at'

                    }

                ]

            });

        }


        $('#filter_sms').click(function(){

            var from_date_sms = $('#from_date_sms').val();

            var to_date_sms = $('#to_date_sms').val();


            if(from_date_sms != '' &&  to_date_sms != ''){

                $('#sms_table').DataTable().destroy();

                load_data(from_date_sms, to_date_sms);

            } else{

                alert('Both Date is required');

            }


        });


        $('#refresh').click(function(){

            $('#from_date_sms').val('');

            $('#to_date_sms').val('');

            $('#sms_table').DataTable().destroy();

            load_data();

        });

    });

</script>





</body>
</html>
