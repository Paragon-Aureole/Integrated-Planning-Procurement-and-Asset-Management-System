<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetIcslipItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_icslip_items', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('asset_id')->unsigned()->nullable()->index();
            $table->integer('asset_icslip_id')->unsigned()->nullable()->index();
            $table->string('description');
            $table->timestamps();
        });

        Schema::table('asset_icslip_items', function (Blueprint $table) {
            // $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
            $table->foreign('asset_icslip_id')->references('id')->on('asset_icslips')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_icslip_items');
    }
}
