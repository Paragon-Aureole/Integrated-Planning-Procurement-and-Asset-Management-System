<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetParItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_par_items', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('asset_id')->unsigned()->nullable()->index();
            $table->integer('asset_par_id')->unsigned()->nullable()->index();
            $table->string('description');
            $table->timestamps();
        });

        Schema::table('asset_par_items', function (Blueprint $table) {
            // $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
            $table->foreign('asset_par_id')->references('id')->on('asset_pars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_par_items');
    }
}
