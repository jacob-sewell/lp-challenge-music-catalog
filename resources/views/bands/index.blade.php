@extends('base')

@section('header')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Bands Listing</h1>
</div>
<div class="links">
    <a href="{{ route('bands.create') }}" class="btn btn-primary">New Band</a>
    <a href="{{ route('albums.index') }}" class="btn btn-info">Albums Listing</a>
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
                    <a class="sorttoggle btn btn-secondary" href="{{ route('bands.sortedindex', ['sortfield' => 'name', 'sortdir' => $sortfield == 'name' ? $sortdir_opposite : 'asc']) }}">
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
                    <a class="sorttoggle btn btn-secondary" href="{{ route('bands.sortedindex', ['sortfield' => 'start_date', 'sortdir' => $sortfield == 'start_date' ? $sortdir_opposite : 'asc']) }}">
                        Formed On
                        @if ($sortfield == 'start_date')
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
                    <a class="sorttoggle btn btn-secondary" href="{{ route('bands.sortedindex', ['sortfield' => 'website', 'sortdir' => $sortfield == 'website' ? $sortdir_opposite : 'asc']) }}">
                        Website
                        @if ($sortfield == 'website')
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
                    <a class="sorttoggle btn btn-secondary" href="{{ route('bands.sortedindex', ['sortfield' => 'still_active', 'sortdir' => $sortfield == 'still_active' ? $sortdir_opposite : 'desc']) }}">
                        Still Active?
                        @if ($sortfield == 'still_active')
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
                    <a class="sorttoggle btn btn-secondary" href="{{ route('bands.sortedindex', ['sortfield' => 'album_count', 'sortdir' => $sortfield == 'album_count' ? $sortdir_opposite : 'desc']) }}">
                        Albums in Catalog
                        @if ($sortfield == 'album_count')
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
            @foreach($bands as $band)
            <tr>
                <td>{{ $band->name }}</td>
                <td>{{ $band->start_date->format('n/j/Y') }}</td>
                <td><a href="{{ $band->website }}" target="_blank" title="Link will open in new tab.">{{ $band->website }}</a></td>
                <td>
                    @if ($band->still_active)
                        Yes
                    @else
                        No
                    @endif
                </td>
                <td>
                    <a href="{{ route('albums.byband', $band->id) }}" title="View albums from {{ $band->name }}">
                        {{ $band_id_x_album_count[$band->id] }} {{ str_plural('Album', $band_id_x_album_count[$band->id]) }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('bands.edit', $band->id) }}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('bands.destroy', $band->id) }}" method="post">
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
