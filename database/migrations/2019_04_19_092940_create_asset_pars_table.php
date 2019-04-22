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
            $table->integer('purchase_order_id')->unsigned()->nullable()->index();
            $table->integer('asset_type_id')->unsigned()->nullable()->index();
			// $table->integer('par_id')->unsigned()->nullable()->index();
			$table->string('name')->default('N/A');
			$table->integer('quantity');
            $table->float('unitCost', 15, 2);
			$table->string('description')->default('N/A');
			$table->string('assignedTo');
			$table->string('position');
            $table->timestamps();
        });

        Schema::table('asset_pars', function (Blueprint $table) {
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
        Schema::dropIfExists('asset_pars');
    }
}
