@extends('layouts.app')

<style type="text/css">
	.allowed-brochure-items {
    padding: 20px 0;
}

.allowed-brochure-item {
    display: flex;
    justify-content: flex-start;
    padding: 0 15px;
    border-top: 1px solid rgba(0, 0, 0, 0.125);
    background-color: #f7f7f7;
    line-height: 80px;
}

.allowed-brochure-item-checkbox {
    width: 30px;
}

.allowed-brochure-item-image {
    width: 40px;
    height: 40px;
}

.allowed-brochure-item-title {
    padding-left: 15px;
}

.allowed-brochure-items-submit {
    text-align: right
}

.allowed-brochure-item-image {
  width: 40px;
  height: 40px;
  top: 22px;
  position: relative;
}

.allowed-brochure-item-checkbox {
  width: 30px;
  margin-top: 32px;
}


</style>
<div class="container-fluid-max py-3">
    

@section('title', __('users.list'))

@section('content')

<div class="container-fluid-max">
    

    <div class="row justify-content-center">

        <!-- sidebar nav -->

        <!-- main content -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                     Assign Brochures
                    <span class="float-right">
                        <a href="{{ route('admin.users') }}" class="btn btn-sm btn-primary">Back</a>
                    </span>
                </div>

                <div class="card-body ml-5">


                    @if(isset($brochures) && count($brochures) > 0)

                        <p>Select the brochure checkboxes and then click 'Assign Brochures' button to assign them to this user.</p>

                        <form action="{{ route('user.update.brochures', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf

                            <div class="allowed-brochure-items-submit">
                                <button type="button" class="btn btn-secondary btn-sm float-left selectallbrochures">Select All</button>
                                <button type="submit" class="btn btn-primary btn-sm">Assign Brochures</button>
                            </div>
                            
                            <div class='allowed-brochure-items'>
                            @foreach($brochures as $brochure)
                                <div class='allowed-brochure-item'>
                                    
                                    <div class='allowed-brochure-item-checkbox'>
                                        @if(in_array($brochure->ID, $brochures_allowed))
                                        <input type='checkbox' name='brochures_allowed[]' value='{{ $brochure->ID }}' checked="checked">
                                        @else
                                        <input type='checkbox' name='brochures_allowed[]' value='{{ $brochure->ID }}'>
                                        @endif
                                    </div>
                                    <div class='allowed-brochure-item-image'><img src='{{ $brochure->image }}' style="width: 50px; height: 50px;"></div>
                                    <div class='allowed-brochure-item-title'>{{ $brochure->title }}</div>

                                </div>
                            @endforeach
                            </div>

                            <div class="allowed-brochure-items-submit">
                                <button type="button" class="btn btn-secondary btn-sm float-left selectallbrochures">Select All</button>
                                <button type="submit" class="btn btn-primary btn-sm">Assign Brochures</button>
                            </div>

                        </form>

                    @else
                        <div class="alert alert-warning" role="alert">No Brochures Found</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>



</div>

@endsection
