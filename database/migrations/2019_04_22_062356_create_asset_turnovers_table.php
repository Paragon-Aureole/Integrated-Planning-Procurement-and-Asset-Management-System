<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetTurnoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_turnovers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('par_id')->unsigned()->nullable()->index();
            $table->boolean('isApproved');
            $table->string('remarks');
            $table->string('assignedTo');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_turnovers');
    }
}
