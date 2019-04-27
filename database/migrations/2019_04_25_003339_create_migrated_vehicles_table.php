<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMigratedVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('migrated_vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asset_type_id')->unsigned()->nullable()->index();
            $table->string('number');
            $table->string('type_of_vehicle');
            $table->string('make');
            $table->string('plate_number');
            $table->string('acquisition_date');
            $table->string('acquisition_cost');
            $table->integer('office_id')->unsigned()->nullable()->index();
            $table->string('accountable_officer');
            $table->string('status');
            $table->timestamps();
        });

        Schema::table('migrated_vehicles', function (Blueprint $table) {
            $table->foreign('asset_type_id')->references('id')->on('asset_types')->onDelete('cascade');
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('migrated_vehicles');
    }
}
