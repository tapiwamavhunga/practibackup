@extends('layouts.app')

<div class="container-fluid-max py-3">
    

@section('title', __('users.list'))

@section('content')



<div class="container-fluid-max">
    

<div class="row">
    <div class="col-xxl-12">
        
        <div class="cardd">
            <div class="card-header">
                <h4 class="card-title">{{ __('users.list') }} <small>{{ __('app.total') }} : {{ $users->total() }} {{ __('users.users') }}</small></h4>

                <div class="float-right">
        @can('create', new App\Models\Users)
            <a href="{{ route('users.index', ['action' => 'create']) }}" class="btn btn-success btn-sm">{{ __('users.create') }}</a>
        @endcan
    </div>

            </div>
        </div>
    </div>
</div>

</div>

<div class="container-fluid-max">

<div class="row mt-5">
    <div class="col-md-12">
        <div class="cardd">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                        <div class="float-right">
                        <label for="q" class="form-label">Search</label>
                        <input placeholder="{{ __('users.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}"></div>
                    
                    <input type="submit" value="{{ __('users.search') }}" class="btn btn-secondary btn-sm">
                    <a href="{{ route('users.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Practice Number</th>
                        <th>Phone Number</th>
                        <th>WhatsApp Number</th>
                        <th>Is Verified</th>
                        <th>Is Admin</th>
                        <th>Created At</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $users)
                    <tr>
                        <td class="text-center">{{ $users->id }}</td>
                        <td>{{ $users->name }}</td>
                        <td>{{ $users->email }}</td>
                        <td>{{ $users->practice_number }}</td>
                        <td>{{ $users->phone_number }}</td>
                        <td>{{ $users->whatsapp_number }}</td>
                        <td>{{ $users->is_verified }}</td>
                        <td>{{ $users->is_admin }}</td>
                        <td>{{ $users->created_at }}</td>

                        <td><a href="{{ route('user.brochures', $users->id) }}" class="btn btn-sm btn-secondary">Brochures</a></td>
                        <td class="text-center">
                            @can('update', $users)
                                <a href="{{ route('users.index', ['action' => 'edit', 'id' => $users->id] + Request::only('page', 'q')) }}" id="edit-users-{{ $users->id }}">{{ __('app.edit') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body"></div>
        </div>
    </div>
    <div class="col-md-12">
        @if(Request::has('action'))
        @include('users.forms')
        @endif
    </div>
</div>
</div>

</div>

@endsection
