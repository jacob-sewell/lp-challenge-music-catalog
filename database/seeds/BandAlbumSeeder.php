<?php

use Illuminate\Database\Seeder;
use App\Band;

class BandAlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Band::class, 10)->create();
    }
}
