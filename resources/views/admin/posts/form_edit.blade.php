<div class="form-group {{ $errors->has('sitename') ? 'has-error' : ''}} mb-4">
    <label for="sitename" class="control-label">{{ 'Site Name' }}</label>
    <input class="form-control" name="sitename" type="text" id="sitename" value="{{ isset($iframe->sitename) ? $iframe->sitename : ''}}" >
    {!! $errors->first('sitename', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('redirect_url') ? 'has-error' : ''}} mb-4">
    <label for="redirect_url" class="control-label">{{ 'Redirect Url' }}</label>
    <input class="form-control" name="redirect_url" type="text" id="redirect_url" value="{{ isset($iframe->redirect_url) ? $iframe->redirect_url : ''}}" >
    {!! $errors->first('redirect_url', '<p class="help-block">:message</p>') !!}
</div>









<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>


