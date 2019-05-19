<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMigratedAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('migrated_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asset_type_id')->unsigned()->nullable()->index();
            $table->string('classification');
            $table->integer('entity_name')->unsigned()->nullable()->index();;
            $table->string('fund_cluster');
            $table->string('receiver_name');
            $table->string('receiver_position');
            $table->string('issuer_name');
            $table->string('issuer_position');
            $table->Double('item_quantity');
            $table->string('item_unit');
            $table->string('property_number');
            $table->date('date_acquired');
            $table->Double('unit_cost');
            $table->Double('amount');
            $table->string('description');
            $table->string('par_number');
            $table->string('item_name');
            $table->string('status');
            $table->timestamps();
        });

        Schema::table('migrated_assets', function (Blueprint $table) {
            $table->foreign('entity_name')->references('id')->on('offices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('migrated_assets');
    }
}
