@extends('layouts.app')
<style type="text/css">

</style>
@section('content')

<div class="container-fluid">
    <div class="pt-5">
            @include('templates.stats')
    </div>

</div>

@foreach ($reports as $report)


@endforeach

@endsection
