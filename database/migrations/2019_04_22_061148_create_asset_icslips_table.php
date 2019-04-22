<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetIcslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_icslips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ics_id');
            $table->string('name');
            $table->integer('quantity');
            $table->string('unit');
            $table->string('description');
            $table->string('assignedTo');
            $table->string('inventory_name_no');
            $table->string('useful_life');
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
        Schema::dropIfExists('asset_icslips');
    }
}
