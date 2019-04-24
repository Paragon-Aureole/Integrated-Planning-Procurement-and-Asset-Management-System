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
            $table->string('name_of_accountable');
            $table->string('official_designation');
            $table->string('lgu');
            $table->string('article');
            $table->string('office_id');
            $table->string('description');
            $table->integer('property_number');
            $table->string('unit_of_measure');
            $table->integer('unit_value');
            $table->integer('balance_per_card');
            $table->integer('on_hand_per_count');
            $table->string('shortage_overage');
            $table->date('date_purchase');
            $table->string('remarks');
            $table->integer('asset_type_id')->unsigned()->nullable()->index();
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
        Schema::dropIfExists('migrated_assets');
    }
}
