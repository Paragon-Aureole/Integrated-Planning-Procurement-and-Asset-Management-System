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
            $table->integer('ics_id')->unsigned()->nullable()->index();
            $table->integer('turnover_id');
            $table->string('name');
            $table->string('description');
            $table->string('remarks');
            $table->string('assignedTo');
            $table->timestamps();
        });

        Schema::table('asset_turnovers', function (Blueprint $table) {
            $table->foreign('par_id')->references('id')->on('asset_pars')->onDelete('cascade');
            $table->foreign('ics_id')->references('id')->on('asset_icslips')->onDelete('cascade');
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
