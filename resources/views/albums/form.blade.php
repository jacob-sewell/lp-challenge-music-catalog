@extends('base')

@section('header')
<div class="row">
<div class="col-sm-12">
    @if ($album && $album->id)
        <h1 class="display-3">Edit Album</h1>
    @else
        <h1 class="display-3">Create Album</h1>
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
      <form method="{{ $album && $album->id ? 'patch' : 'post' }}" action="{{ ($album && $album->id ? route('albums.update', $album->id) : route('albums.store')) }}">
          @csrf
          <div class="form-group">
              <label for="name">Album Name:*</label>
              <input type="text" class="form-control" name="name" value="{{ $album && $album->id ? $album->name : '' }}" />
          </div>

          <div class="form-group">
              <label for="band_id">Band:*</label>
              <select name="band_id">
                @foreach ($all_bands as $band)
                    <option {{ $album && $album->band()->first()->id == $band->id ? 'selected="selected"' : '' }} value="{{ $band->id }}">{{ $band->name }}</option>
                @endforeach
              </select>
          </div>

          <div class="form-group">
              <label for="recorded_date">Recorded On:</label>
              <input type="text" class="form-control" name="recorded_date" value="{{ $album && $album->recorded_date ? $album->recorded_date->format('Y-m-d') : '' }}" />
          </div>

          <div class="form-group">
              <label for="release_date">Release Date:</label>
              <input type="text" class="form-control" name="release_date" value="{{ $album && $album->release_date ? $album->release_date->format('Y-m-d') : '' }}" />
          </div>

          <div class="form-group">
              <label for="number_of_tracks"># of Tracks:</label>
              <input type="number" class="form-control" name="number_of_tracks" value="{{ $album && $album->id ? $album->number_of_tracks : '' }}" />
          </div>

          <div class="form-group">
              <label for="label">Label:</label><!-- Label doesn't even look like a word now. -->
              <input type="text" class="form-control" name="label" value="{{ $album && $album->id ? $album->label : '' }}" />
          </div>

          <div class="form-group">
              <label for="producer">Producer:</label>
              <input type="text" class="form-control" name="producer" value="{{ $album && $album->id ? $album->producer : '' }}" />
          </div>

          <div class="form-group">
              <label for="genre">Genre:</label>
              <input type="text" class="form-control" name="genre" value="{{ $album && $album->id ? $album->genre : '' }}" />
          </div>

          <button type="submit" class="btn btn-primary-outline">
            @if ($album && $album->id)
                Update
            @else
                Add
            @endif
            album
        </button>
      </form>
  </div>
</div>
</div>
@endsection
