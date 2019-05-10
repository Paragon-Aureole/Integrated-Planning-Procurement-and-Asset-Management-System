<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMigratedIcsAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('migrated_ics_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('classification');
            $table->integer('asset_type_id')->unsigned()->nullable()->index();
            $table->string('receiver_name');
            $table->string('receiver_position');
            $table->string('issuer_name');
            $table->string('issuer_position');
            $table->integer('item_quantity');
            $table->string('item_unit');
            $table->string('inventory_item_number');
            $table->string('estimated_useful_life');
            $table->string('description');
            $table->string('ics_number');
            $table->timestamps();
        });

        Schema::table('migrated_ics_assets', function (Blueprint $table) {
            $table->foreign('asset_type_id')->references('id')->on('asset_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('migrated_ics_assets');
    }
}
