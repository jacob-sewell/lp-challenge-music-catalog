<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Create albums table
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::create('albums', function (Blueprint $table) {
                $table->bigIncrements('id');

                $table->unsignedBigInteger('band_id');
                $table->foreign('band_id')
                    ->references('id')
                    ->on('bands')
                    ->onDelete('cascade');

                $table->string('name', 255);

                $table->date('recorded_date')->nullable();

                $table->date('release_date')->nullable();

                $table->unsignedSmallInteger('number_of_tracks')->nullable();

                $table->string('label', 255);

                $table->string('producer', 255)->nullable();

                $table->string('genre', 255);

                $table->timestamps();
            });
        } catch (Throwable $e) {
            // Having to manually drop a table when your migration fails is annoying.
            if (Schema::hasTable('albums')) Schema::drop('albums');
            throw $e;
        }
    }

    /**
     * Drop albums table
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('albums');
    }
}
