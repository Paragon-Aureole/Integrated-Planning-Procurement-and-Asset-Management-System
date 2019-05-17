<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetParsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_pars', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('purchase_order_id')->unsigned()->nullable()->index();
            $table->integer('asset_id')->unsigned()->nullable()->index();
            $table->integer('quantity');
            // $table->string('description')->default('N/A');
            $table->string('property_no')->nullable()->default('');
            $table->string('assignedTo');
            $table->string('position');
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
        Schema::dropIfExists('asset_pars');
    }
}
