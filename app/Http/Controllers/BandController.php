<?php

namespace App\Http\Controllers;

use App\Band;
use Illuminate\Http\Request;

class BandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sortedindex();
    }

    public function sortedindex($sortfield = 'name', $sortdir = 'asc') {
        $sortdir_opposite = $sortdir == 'desc' ? 'asc' : 'desc';
        if ($sortfield == 'album_count') {
            $bands = [];
            Band::all()->each(function($band) use(&$bands) { $bands[] = $band; });
            usort($bands, function($a, $b) use($sortdir) {
                return ($sortdir == 'asc' ? -1 : 1) * ($b->getAlbumCount() - $a->getAlbumCount());
            });
        } else {
            $bands = Band::orderBy($sortfield, $sortdir)->get();
        }
        foreach ($bands as $band) {
            $band_id_x_album_count[$band->id] = $band->getAlbumCount();
        }
        return view('bands.index', compact('bands', 'band_id_x_album_count', 'sortfield', 'sortdir', 'sortdir_opposite'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $band = false;
        return view('bands.form', compact('band'));
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
        ]);

        $field_names = [
            'name',
            'start_date',
            'website',
            'still_active',
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
        $model_data['start_date'] = $model_data['start_date'] ? strtotime($model_data['start_date']) : null;
        $model_data['still_active'] = !!$model_data['still_active'];
        $model = new Band($model_data);
        $model->save();

        return redirect('bands')->with('success', 'Band created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Band  $band
     * @return \Illuminate\Http\Response
     */
    public function show(Band $band)
    {
        // Use the filtered version of the album listing for this
        return redirect('albums/byband/'.$band->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Band  $band
     * @return \Illuminate\Http\Response
     */
    public function edit(Band $band)
    {
        return view('bands.form', compact('band'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Band  $band
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Band $band)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $band->save();

        return redirect('bands')->with('success', 'Band updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Band  $band
     * @return \Illuminate\Http\Response
     */
    public function destroy(Band $band)
    {
        $band->delete();

        return redirect('bands')->with('success', 'Band deleted.');
    }
}
