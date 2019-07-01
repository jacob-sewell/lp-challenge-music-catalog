<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'website',
        'still_active',
    ];

    protected $attributes = [
        'still_active' => true,
    ];

    protected $dates = ['start_date'];

    public function albums() {
        return $this->hasMany(Album::class);
    }

    public function getAlbumCount() {
        return $this->albums()->get()->count();
    }
}
