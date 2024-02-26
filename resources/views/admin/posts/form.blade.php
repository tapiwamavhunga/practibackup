<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}} mb-4">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($post->title) ? $post->title : ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('link') ? 'has-error' : ''}} mb-4">
    <label for="link" class="control-label">{{ 'Link Url' }}</label>
    <input class="form-control" name="link" type="text" id="link" value="{{ isset($post->link) ? $post->link : ''}}" >
    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    <label for="content" class="control-label">{{ 'Content' }}</label>
    <textarea class="form-control" rows="5" name="content" type="textarea" id="content" >{{ isset($post->content) ? $post->content : ''}}</textarea>
    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>


<div class="col-12 mt-5 mb-3 form-group {{ $errors->has('current_campaign') ? 'has-error' : ''}}">
    <label for="current_campaign" class="control-label mb-3">Make {{ isset($post->title) ? $post->title : ''}}  a Campaign Post</label>
    <select name="current_campaign" class="form-control" id="current_campaign" >
    @foreach (json_decode('{"2": "Select", "1": "Yes", "0": "No"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($post->current_campaign) && $post->current_campaign == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('current_campaign', '<p class="help-block">:message</p>') !!}
</div>


<div class="col-12 mt-5 mb-3 form-group {{ $errors->has('featured_brochures') ? 'has-error' : ''}}">
    <label for="featured_brochures" class="control-label mb-3">Make {{ isset($post->title) ? $post->title : ''}}  a Featured Post</label>
    <select name="featured_brochures" class="form-control" id="featured_brochures" >
    @foreach (json_decode('{"2": "Select", "1": "Yes", "0": "No"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($post->featured_brochures) && $post->featured_brochures == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('featured_brochures', '<p class="help-block">:message</p>') !!}
</div>



<div class="col-12 mt-5 mb-3 form-group {{ $errors->has('main_landing_brochures') ? 'has-error' : ''}}">
    <label for="main_landing_brochures" class="control-label mb-3">Make {{ isset($post->title) ? $post->title : ''}}  a Related Post</label>
    <select name="main_landing_brochures" class="form-control" id="main_landing_brochures" >
    @foreach (json_decode('{"2": "Select", "1": "Yes", "0": "No"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($post->main_landing_brochures) && $post->main_landing_brochures == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('main_landing_brochures', '<p class="help-block">:message</p>') !!}
</div>







<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}} mt-5 mb-5">

<label>Choose Images</label>
<input type="file"  name="image" >
</div>


<div class="row">
 




    

</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>


