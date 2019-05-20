<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetTurnoverItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_turnover_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asset_turnover_id')->unsigned()->nullable()->index();
            $table->integer('asset_par_item_id')->unsigned()->nullable()->index();
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
        Schema::dropIfExists('asset_turnover_items');
    }
}
