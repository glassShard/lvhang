<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveRefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_refs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('performer');

            $table->unsignedBigInteger('live_ref_place_id')->index();
            $table->foreign('live_ref_place_id')->references('id')->on('live_ref_places');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live_refs');
    }
}
