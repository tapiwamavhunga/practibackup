<div class="form-group {{ $errors->has('sitename') ? 'has-error' : ''}} mb-4">
    <label for="sitename" class="control-label">{{ 'Site Name' }}</label>
    <input class="form-control" name="sitename" type="text" id="sitename" value="{{ isset($post->sitename) ? $post->sitename : ''}}" >
    {!! $errors->first('sitename', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('redirect_url') ? 'has-error' : ''}} mb-4">
    <label for="redirect_url" class="control-label">{{ 'Redirect Url' }}</label>
    <input class="form-control" name="redirect_url" type="text" id="redirect_url" value="{{ isset($post->redirect_url) ? $post->redirect_url : ''}}" >
    {!! $errors->first('redirect_url', '<p class="help-block">:message</p>') !!}
</div>


<div class="row">
    <div class="form-group col-md-4">
            <label for="redirect_url" class="control-label">Featured Brochures</label>

<div class='allowed-brochure-items'>
                            @foreach($brochures as $brochure)
                                <div class='allowed-brochure-item'>
                                    
                                    <div class='allowed-brochure-item-checkbox'>
                                       
                                        <input type='checkbox' name='featured_brochures[]' value='{{ $brochure->ID }}'>
                                    </div>
                                    
                                    <div class='allowed-brochure-item-title'>{{ $brochure->title }}</div>

                                </div>
                            @endforeach
                            </div>

</div>



    <div class="form-group col-md-4">
            <label for="redirect_url" class="control-label">Main Landing Brochures</label>

<div class='allowed-brochure-items'>
                            @foreach($brochures as $brochure)
                                <div class='allowed-brochure-item'>
                                    
                                    <div class='allowed-brochure-item-checkbox'>
                                       
                                        <input type='checkbox' name='main_landing_brochures[]' value='{{ $brochure->ID }}'>
                                    </div>
                                    
                                    <div class='allowed-brochure-item-title'>{{ $brochure->title }}</div>

                                </div>
                            @endforeach
                            </div>

</div>


    <div class="form-group col-md-4">
            <label for="redirect_url" class="control-label">Current Brochures</label>

<div class='allowed-brochure-items'>
                            @foreach($brochures as $brochure)
                                <div class='allowed-brochure-item'>
                                    
                                    <div class='allowed-brochure-item-checkbox'>
                                       
                                        <input type='checkbox' name='current_campaign[]' value='{{ $brochure->ID }}'>
                                    </div>
                                    
                                    <div class='allowed-brochure-item-title'>{{ $brochure->title }}</div>

                                </div>
                            @endforeach
                            </div>

</div>


</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>


