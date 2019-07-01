@extends('albums.base')

@section('header')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Albums Listing</h1>
</div>
<div class="links">
    <a href="{{ route('albums.create') }}" class="btn btn-primary">New Album</a>
    <a href="{{ route('bands.index') }}" class="btn btn-info">Bands Listing</a>
    <span class="bandchooser">
        <a id="band-filter-btn" href="#" class="btn btn-secondary">
            Filter By Band:&nbsp;
            <select name="band_id">
                @foreach ($all_bands as $band)
                    <option value="{{ $band->id }}" {{ $band->id == $band_id ? 'selected="selected"' : '' }} data-link="{{ route('albums.byband', ['band_id' => $band->id]) }}">{{ $band->name }}</option>
                @endforeach
            </select>
        </a>
        <script type="text/javascript">
            var bandChooser = document.querySelectorAll(".bandchooser select[name=band_id]")[0];
            bandChooser.addEventListener(
                "change",
                function() {
                    var url = "#";
                    var selectedBand = bandChooser[bandChooser.selectedIndex];
                    if (selectedBand && selectedBand.getAttribute("data-link")) url = selectedBand.getAttribute("data-link");
                    document.getElementById("band-filter-btn").setAttribute("href", url);
                }
            );
        </script>
    </span>
</div>
</div>
@endsection

@section('main')
<div class="row">
<div class="col-sm-12">
    <table class="table table-striped">
		<thead>
            <tr>
                <td>
                    <a class="sorttoggle btn btn-secondary" href="{{ $band_id ? route('albums.byband', ['band_id' => $band_id, 'sortfield' => 'name', 'sortdir' => $sortfield == 'name' ? $sortdir_opposite : 'asc']) : route('albums.sortedindex', ['sortfield' => 'name', 'sortdir' => $sortfield == 'name' ? $sortdir_opposite : 'asc']) }}">
                        Name
                        @if ($sortfield == 'name')
                            &nbsp;
                            @if ($sortdir == 'desc')
                            	&darr;
                            @else
                            	&uarr;
                            @endif
                        @endif
                    </a>
                </td>
                <td>
                    <a class="sorttoggle btn btn-secondary" href="{{ $band_id ? route('albums.byband', ['band_id' => $band_id, 'sortfield' => 'band_name', 'sortdir' => $sortfield == 'band_name' ? $sortdir_opposite : 'asc']) : route('albums.sortedindex', ['sortfield' => 'band_name', 'sortdir' => $sortfield == 'band_name' ? $sortdir_opposite : 'asc']) }}">
                        Band
                        @if ($sortfield == 'band_name')
                            &nbsp;
                            @if ($sortdir == 'desc')
                            	&darr;
                            @else
                            	&uarr;
                            @endif
                        @endif
                    </a>
                </td>
                <td>
                    <a class="sorttoggle btn btn-secondary" href="{{ $band_id ? route('albums.byband', ['band_id' => $band_id, 'sortfield' => 'recorded_date', 'sortdir' => $sortfield == 'recorded_date' ? $sortdir_opposite : 'asc']) : route('albums.sortedindex', ['sortfield' => 'recorded_date', 'sortdir' => $sortfield == 'recorded_date' ? $sortdir_opposite : 'asc']) }}">
                        Recorded Date
                        @if ($sortfield == 'recorded_date')
                            &nbsp;
                            @if ($sortdir == 'desc')
                            	&darr;
                            @else
                            	&uarr;
                            @endif
                        @endif
                    </a>
                </td>
                <td>
                    <a class="sorttoggle btn btn-secondary" href="{{ $band_id ? route('albums.byband', ['band_id' => $band_id, 'sortfield' => 'release_date', 'sortdir' => $sortfield == 'release_date' ? $sortdir_opposite : 'asc']) : route('albums.sortedindex', ['sortfield' => 'release_date', 'sortdir' => $sortfield == 'release_date' ? $sortdir_opposite : 'asc']) }}">
                        Release Date
                        @if ($sortfield == 'release_date')
                            &nbsp;
                            @if ($sortdir == 'desc')
                            	&darr;
                            @else
                            	&uarr;
                            @endif
                        @endif
                    </a>
                </td>
                <td>
                    <a class="sorttoggle btn btn-secondary" href="{{ $band_id ? route('albums.byband', ['band_id' => $band_id, 'sortfield' => 'number_of_tracks', 'sortdir' => $sortfield == 'number_of_tracks' ? $sortdir_opposite : 'asc']) : route('albums.sortedindex', ['sortfield' => 'number_of_tracks', 'sortdir' => $sortfield == 'number_of_tracks' ? $sortdir_opposite : 'asc']) }}">
                        # of Tracks
                        @if ($sortfield == 'number_of_tracks')
                            &nbsp;
                            @if ($sortdir == 'desc')
                            	&darr;
                            @else
                            	&uarr;
                            @endif
                        @endif
                    </a>
                </td>
                <td>
                    <a class="sorttoggle btn btn-secondary" href="{{ $band_id ? route('albums.byband', ['band_id' => $band_id, 'sortfield' => 'label', 'sortdir' => $sortfield == 'label' ? $sortdir_opposite : 'asc']) : route('albums.sortedindex', ['sortfield' => 'label', 'sortdir' => $sortfield == 'label' ? $sortdir_opposite : 'asc']) }}">
                        Label
                        @if ($sortfield == 'label')
                            &nbsp;
                            @if ($sortdir == 'desc')
                            	&darr;
                            @else
                            	&uarr;
                            @endif
                        @endif
                    </a>
                </td>
                <td>
                    <a class="sorttoggle btn btn-secondary" href="{{ $band_id ? route('albums.byband', ['band_id' => $band_id, 'sortfield' => 'producer', 'sortdir' => $sortfield == 'producer' ? $sortdir_opposite : 'asc']) : route('albums.sortedindex', ['sortfield' => 'producer', 'sortdir' => $sortfield == 'producer' ? $sortdir_opposite : 'asc']) }}">
                        Producer
                        @if ($sortfield == 'producer')
                            &nbsp;
                            @if ($sortdir == 'desc')
                            	&darr;
                            @else
                            	&uarr;
                            @endif
                        @endif
                    </a>
                </td>
                <td>
                    <a class="sorttoggle btn btn-secondary" href="{{ $band_id ? route('albums.byband', ['band_id' => $band_id, 'sortfield' => 'genre', 'sortdir' => $sortfield == 'genre' ? $sortdir_opposite : 'asc']) : route('albums.sortedindex', ['sortfield' => 'genre', 'sortdir' => $sortfield == 'genre' ? $sortdir_opposite : 'asc']) }}">
                        Genre
                        @if ($sortfield == 'genre')
                            &nbsp;
                            @if ($sortdir == 'desc')
                            	&darr;
                            @else
                            	&uarr;
                            @endif
                        @endif
                    </a>
                </td>
                <td colspan="2" title="Actions">&nbsp;</td>
            </tr>
		</thead>
		<tbody>
            @foreach($albums as $album)
            <tr>
                <td>{{ $album->name }}</td>
                <td>{{ $album->band()->first()->name }}</td>
                <td>{{ $album->recorded_date->format('n/j/Y') }}</td>
                <td>{{ $album->release_date->format('n/j/Y') }}</td>
                <td>{{ $album->number_of_tracks }}</td>
                <td>{{ $album->label }}</td>
                <td>{{ $album->producer }}</td>
                <td>{{ $album->genre }}</td>
                <td>
                    <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('albums.destroy', $album->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
		</tbody>
	</table>
<div>
</div>
@endsection
