@if (Request::get('action') == 'create')
@can('create', new App\Models\Vehicle)
    <form method="POST" action="{{ route('vehicles.store') }}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title" class="form-label">{{ __('vehicle.title') }} <span class="form-required">*</span></label>
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required>
            {!! $errors->first('title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('vehicle.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description') }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input type="submit" value="{{ __('app.create') }}" class="btn btn-success">
        <a href="{{ route('vehicles.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
    </form>
@endcan
@endif
@if (Request::get('action') == 'edit' && $editableVehicle)
@can('update', $editableVehicle)
    <form method="POST" action="{{ route('vehicles.update', $editableVehicle) }}" accept-charset="UTF-8">
        {{ csrf_field() }} {{ method_field('patch') }}
        <div class="form-group">
            <label for="title" class="form-label">{{ __('vehicle.title') }} <span class="form-required">*</span></label>
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $editableVehicle->title) }}" required>
            {!! $errors->first('title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('vehicle.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $editableVehicle->description) }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input name="page" value="{{ request('page') }}" type="hidden">
        <input name="q" value="{{ request('q') }}" type="hidden">
        <input type="submit" value="{{ __('vehicle.update') }}" class="btn btn-success">
        <a href="{{ route('vehicles.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        @can('delete', $editableVehicle)
            <a href="{{ route('vehicles.index', ['action' => 'delete', 'id' => $editableVehicle->id] + Request::only('page', 'q')) }}" id="del-vehicle-{{ $editableVehicle->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
        @endcan
    </form>
@endcan
@endif
@if (Request::get('action') == 'delete' && $editableVehicle)
@can('delete', $editableVehicle)
    <div class="card">
        <div class="card-header">{{ __('vehicle.delete') }}</div>
        <div class="card-body">
            <label class="form-label text-primary">{{ __('vehicle.title') }}</label>
            <p>{{ $editableVehicle->title }}</p>
            <label class="form-label text-primary">{{ __('vehicle.description') }}</label>
            <p>{{ $editableVehicle->description }}</p>
            {!! $errors->first('vehicle_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <hr style="margin:0">
        <div class="card-body text-danger">{{ __('vehicle.delete_confirm') }}</div>
        <div class="card-footer">
            <form method="POST" action="{{ route('vehicles.destroy', $editableVehicle) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                {{ csrf_field() }} {{ method_field('delete') }}
                <input name="vehicle_id" type="hidden" value="{{ $editableVehicle->id }}">
                <input name="page" value="{{ request('page') }}" type="hidden">
                <input name="q" value="{{ request('q') }}" type="hidden">
                <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
            </form>
            <a href="{{ route('vehicles.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        </div>
    </div>
@endcan
@endif
