<?php

namespace App\Http\Controllers;

use App\Album;
use App\Band;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    protected function all_bands() {
        return Band::orderBy('name', 'asc')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sortedindex();
    }

    public function sortedindex($sortfield = 'release_date', $sortdir = 'asc') {
        return $this->byBand(null, $sortfield, $sortdir);
    }

    public function byBand($band_id, $sortfield = 'release_date', $sortdir = 'asc') {
        $sortdir_opposite = $sortdir == 'desc' ? 'asc' : 'desc';
        $band = $band_id ? Band::find($band_id) : null;
        if ($sortfield == 'band_name') {
            $sorter = function($a, $b) use($sortdir) {
                return ($sortdir == 'desc' ? -1 : 1) * strcmp($a->band()->first()->name, $b->band()->first()->name);
            };
        } else {
            $sorter = function($a, $b) use($sortdir, $sortfield) {
                $dir = $sortdir == 'desc' ? -1 : 1;
                $cmp = 0;
                if ($a->{$sortfield} > $b->{$sortfield}) {
                    $cmp = 1;
                } else if ($a->{$sortfield} < $b->{$sortfield}) {
                    $cmp = -1;
                }
                return $dir * $cmp;
            };
        }
        $albums = [];
        ($band_id ? $band->albums()->get() : Album::all())->each(function($album) use(&$albums) {
            $albums[] = $album;
        });
        usort($albums, $sorter);

        $all_bands = $this->all_bands();
        return view('albums.index', compact('albums', 'band', 'sortfield', 'sortdir', 'sortdir_opposite', 'all_bands', 'band_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $album = false;
        $all_bands = $this->all_bands();
        return view('albums.form', compact('album', 'all_bands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'band_id' => 'required',
        ]);

        $field_names = [
            'name',
            'band_id',
            'recorded_date',
            'release_date',
            'number_of_tracks',
            'label',
            'producer',
            'genre',
        ];

        $model_data = array_combine(
            $field_names,
            array_map(
                function($fn) use($request) {
                    return $request->get($fn);
                },
                $field_names
            )
        );
        $model_data['recorded_date'] = $model_data['recorded_date'] ? strtotime($model_data['recorded_date']) : null;
        $model_data['release_date'] = $model_data['release_date'] ? strtotime($model_data['release_date']) : null;
        $model = new Album($model_data);
        $model->save();

        return redirect('bands')->with('success', 'Band created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        // Skip this
        return redirect('albums');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        $all_bands = $this->all_bands();
        return view('albums.form', compact('album', 'all_bands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $request->validate([
            'name' => 'required',
            'band_id' => 'required',
        ]);
        $album->save();

        return redirect('albums')->with('success', 'Album updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album->delete();

        return redirect('albums')->with('success', 'Album deleted.');
    }
}
