@if (Request::get('action') == 'create')
@can('create', new App\Models\Users)
    <form method="POST" action="{{ route('users.store') }}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title" class="form-label">{{ __('users.title') }} <span class="form-required">*</span></label>
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required>
            {!! $errors->first('title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('users.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description') }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input type="submit" value="{{ __('app.create') }}" class="btn btn-success">
        <a href="{{ route('users.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
    </form>
@endcan
@endif
@if (Request::get('action') == 'edit' && $editableUsers)
@can('update', $editableUsers)

<div class="container-fluid-max">
    
<div class="row">
    <div class="col-xxl-12">
        
    <div class="card" style="padding: 23px;">

    <form method="POST" action="{{ route('users.update', $editableUsers) }}" accept-charset="UTF-8">
        {{ csrf_field() }} {{ method_field('patch') }}
        <div class="form-group">
            <label for="Name" class="form-label">Name <span class="form-required">*</span></label>
            <input id="title" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $editableUsers->name) }}" required>
            {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>

        <div class="form-group">
            <label for="Surname" class="form-label">Surname <span class="form-required">*</span></label>
            <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname', $editableUsers->surname) }}" required>
            {!! $errors->first('surname', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>


        <div class="form-group">
            <label for="description" class="form-label">{{ __('users.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $editableUsers->description) }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input name="page" value="{{ request('page') }}" type="hidden">
        <input name="q" value="{{ request('q') }}" type="hidden">
        <input type="submit" value="{{ __('users.update') }}" class="btn btn-success">
        <a href="{{ route('users.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        @can('delete', $editableUsers)
            <a href="{{ route('users.index', ['action' => 'delete', 'id' => $editableUsers->id] + Request::only('page', 'q')) }}" id="del-users-{{ $editableUsers->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
        @endcan
    </form>

    </div>
</div>
    </div>
</div>
@endcan
@endif
@if (Request::get('action') == 'delete' && $editableUsers)
@can('delete', $editableUsers)
    <div class="card">
        <div class="card-header">{{ __('users.delete') }}</div>
        <div class="card-body">
            <label class="form-label text-primary">{{ __('users.title') }}</label>
            <p>{{ $editableUsers->title }}</p>
            <label class="form-label text-primary">{{ __('users.description') }}</label>
            <p>{{ $editableUsers->description }}</p>
            {!! $errors->first('users_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <hr style="margin:0">
        <div class="card-body text-danger">{{ __('users.delete_confirm') }}</div>
        <div class="card-footer">
            <form method="POST" action="{{ route('users.destroy', $editableUsers) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                {{ csrf_field() }} {{ method_field('delete') }}
                <input name="users_id" type="hidden" value="{{ $editableUsers->id }}">
                <input name="page" value="{{ request('page') }}" type="hidden">
                <input name="q" value="{{ request('q') }}" type="hidden">
                <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
            </form>
            <a href="{{ route('users.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        </div>
    </div>
@endcan
@endif
