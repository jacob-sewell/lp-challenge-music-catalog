<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    protected $attributes = [
        'still_active' => true,
    ];

    public function albums() {
        return $this->hasMany(Album::class);
    }
}
