@extends('base')

@section('bandchooser')
    <select name="band_id">
        @foreach ($all_bands as $band)
            <option value="{{ $band->id }}">{{ $band->name }}</option>
        @endforeach
    </select>
@endsection
