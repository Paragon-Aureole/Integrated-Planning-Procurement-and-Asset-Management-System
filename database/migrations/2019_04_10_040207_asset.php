<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Asset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('purchase_order_id')->unsigned()->nullable()->index();
			$table->string('details');
            $table->double('amount', 15, 2);
            $table->integer('item_quantity');
			$table->boolean('isSup')->nullable()->default(FALSE);
			$table->boolean('isICS')->nullable()->default(FALSE);
			$table->boolean('isPAR')->nullable()->default(FALSE);
            $table->timestamps();

            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
