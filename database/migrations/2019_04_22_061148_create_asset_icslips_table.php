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
            $table->integer('purchase_order_id')->unsigned()->nullable()->index();
            $table->integer('asset_type_id')->unsigned()->nullable()->index();
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

        Schema::table('asset_icslips', function (Blueprint $table) {
            $table->foreign('asset_type_id')->references('id')->on('asset_types')->onDelete('cascade');
            $table->foreign('purchase_order_id')->references('purchase_order_id')->on('assets')->onDelete('cascade');
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
