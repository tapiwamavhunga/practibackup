@extends('layouts.apptables')
@section('content')

<style type="text/css">
    .sorting_asc, .sorting {
  font-size: 14px !important;
}


.table tr td {
  font-weight: 300;
  font-size: 14px !important;
}


.content-body {
  margin-left:0px  !important;
  margin-right: 0px !important;
}

#filter,#filter_whatsapp, #filter_sms {
  margin-top: 3px;
}



</style>
  <div class="content-body " style="background: #fff !important;">
                <div class="container-fluid pb-5 pt-5">    






   <div class="row">
        <div class="col-xl-12">
          <div class="card-header mb-5">
              <h4 class="card-title">Email Reports</h4>
              
                            <a class="btn btn-success btn-sm" href="/email/export">Export Emails</a>

            </div>
        </div>
      </div>

    <div class="row input-daterange">

        <div class="col-md-3">

            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />

        </div>

        <div class="col-md-3">

            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />

        </div>

        <div class="col-md-4">

            <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>

            <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>

        </div>

    </div>

    <br />

    <div class="table-responsive mt-5">

        <table class="table  table-striped" id="order_table">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Brochure</th>

                    <th>Email sent by</th>
                    <th>Email sent to</th>
                    <th>Recipients</th>
                    <th>Open</th>
                    <th>Clicks</th>
                    <th>Sub Region</th>
                    <th>Date Sent</th>

                </tr>

            </thead>

        </table>

    </div>


    <div class="row mt-5">
        <div class="col-xl-12">
          

          <div class="card-header mb-5">
              <h4 class="card-title">Whatsapp Reports</h4>
              <a class="btn btn-success btn-sm" href="/whatsapp/export">Export Whatsapp</a>
            </div>


        </div>
      </div>


     <div class="row input-daterange">

        <div class="col-md-3">

            <input type="text" name="from_date_whatsapp" id="from_date_whatsapp" class="form-control" placeholder="From Date" readonly />

        </div>

        <div class="col-md-3">

            <input type="text" name="to_date_whatsapp" id="to_date_whatsapp" class="form-control" placeholder="To Date" readonly />

        </div>

        <div class="col-md-4">

            <button type="button" name="filter_whatsapp" id="filter_whatsapp" class="btn btn-primary">Filter</button>

            <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>

        </div>

    </div>


    <div class="table-responsive mt-5">

        <table class="table  table-striped" id="whatsapp_table">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Brochure</th>

                    <th>Sent by</th>
                    <th>Sent to</th>
                    <th>URL</th>
                    <th>Clicks</th>
                    <th>Sub Region</th>
                    <th>Date Sent</th>

                </tr>

            </thead>

        </table>

    </div>



      <div class="row mt-5">
        <div class="col-xl-12">
          

          <div class="card-header mb-5">
              <h4 class="card-title">SMS Reports</h4>
                <a class="btn btn-success btn-sm" href="/sms/export">Export SMSs</a>
            </div>


        </div>
      </div>


      <div class="row input-daterange">

        <div class="col-md-3">

            <input type="text" name="from_date_sms" id="from_date_sms" class="form-control" placeholder="From Date" readonly />

        </div>

        <div class="col-md-3">

            <input type="text" name="to_date_sms" id="to_date_sms" class="form-control" placeholder="To Date" readonly />

        </div>

        <div class="col-md-4">

            <button type="button" name="filter_sms" id="filter_sms" class="btn btn-primary">Filter</button>

            <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>

        </div>

    </div>
    


    <div class="table-responsive mt-5">

        <table class="table  table-striped" id="sms_table">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Brochure</th>

                    <th>Sent by</th>
                    <th>Sent to</th>
                    <th>URL</th>
                    <th>Clicks</th>
                      <th>Sub Region</th>
                      
                    <th>Date Sent</th>

                </tr>

            </thead>

        </table>

    </div>




</div>




@endsection


<script src="{{ asset('js/scripts.js') }}"></script>
