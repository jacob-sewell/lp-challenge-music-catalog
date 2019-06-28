<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBandsTable extends Migration
{
    /**
     * Create bands table.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::create('bands', function (Blueprint $table) {
                $table->bigIncrements('id');

                $table->string('name', 255);

                $table->date('start_date')->nullable();

                $table->string('website', 255)->nullable();

                $table->boolean('still_active');

                $table->timestamps();
            });
        } catch (Throwable $e) {
            // Having to manually drop a table when your migration fails is annoying.
            if (Schema::hasTable('bands')) Schema::drop('bands');
            throw $e;
        }
    }

    /**
     * Drop bands table.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bands');
    }
}
