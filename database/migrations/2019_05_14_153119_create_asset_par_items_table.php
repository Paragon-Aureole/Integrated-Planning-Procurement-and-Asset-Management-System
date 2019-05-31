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
            $table->integer('asset_par_id')->unsigned()->nullable()->index();
            $table->integer('asset_id')->unsigned()->nullable()->index();
            // $table->integer('asset_turnover_id')->unsigned()->nullable()->index();
            $table->string('description');
            $table->string('itemStatus');
            $table->integer('quantity');
            $table->date('date_acquired');
            $table->string('property_no')->nullable()->default('');
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
        Schema::dropIfExists('asset_par_items');
    }
}
