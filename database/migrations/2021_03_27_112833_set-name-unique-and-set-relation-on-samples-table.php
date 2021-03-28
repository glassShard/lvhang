<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetNameUniqueAndSetRelationOnSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('samples', function (Blueprint $table) {
            $table->unique('name');
            $table->foreign('parent_id')->references('id')->on('samples');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unique_in_samples', function (Blueprint $table) {
            $table->dropUnique('name');
        });

        Schema::table('samples', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });
    }
}
