@extends('base')

@section('header')
<div class="row">
<div class="col-sm-12">
    @if ($band && $band->id)
        <h1 class="display-3">Edit Band</h1>
    @else
        <h1 class="display-3">Create Band</h1>
    @endif
</div>
<div class="links">
    <a href="{{ route('bands.index') }}" class="btn btn-info">Bands Listing</a>
    <a href="{{ route('albums.index') }}" class="btn btn-info">Albums Listing</a>
</div>
</div>
@endsection

@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('bands.'.($band && $band->id ? 'update' : 'store')) }}">
          @csrf
          <div class="form-group">
              <label for="name">Band Name:*</label>
              <input type="text" class="form-control" name="name" value="{{ $band && $band->id ? $band->name : '' }}" />
          </div>

          <div class="form-group">
              <label for="start_date">Formed On:</label>
              <input type="text" class="form-control" name="start_date" value="{{ $band && $band->start_date ? $band->start_date->format('Y-m-d') : '' }}" />
          </div>

          <div class="form-group">
              <label for="website">Website:</label>
              <input type="text" class="form-control" name="website" value="{{ $band && $band->id ? $band->website : '' }}" />
          </div>

          <div class="form-group">
              <label for="still_active">Still Active?</label>
              @if (!$band || ($band && $band->still_active))
                <input type="checkbox" class="form-control" name="still_active" value="1" checked="checked" />
              @else
                <input type="checkbox" class="form-control" name="still_active" value="1" />
              @endif
          </div>
          <button type="submit" class="btn btn-primary-outline">
            @if ($band && $band->id)
                Update
            @else
                Add
            @endif
            band
        </button>
      </form>
  </div>
</div>
</div>
@endsection
