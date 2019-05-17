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
            // $table->integer('purchase_order_id')->unsigned()->nullable()->index();
            $table->integer('asset_id')->unsigned()->nullable()->index();
            // $table->integer('asset_type_id')->unsigned()->nullable()->index();
            $table->integer('quantity');
            $table->string('description');
            $table->string('assignedTo');
            $table->string('position');
            $table->string('inventory_name_no')->nullable()->default('');
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
