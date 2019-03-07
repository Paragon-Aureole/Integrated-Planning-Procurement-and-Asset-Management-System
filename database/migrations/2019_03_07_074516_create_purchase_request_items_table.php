<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequestItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_request_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_request_id')->unsigned()->index()->nullable();
            $table->integer('measurement_unit_id')->unsigned()->index()->nullable();
            $table->string('item_description');
            $table->integer('item_quantity');
            $table->decimal('item_cpu', 15, 2);
            $table->decimal('item_cpi', 15, 2);
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
        Schema::dropIfExists('purchase_request_items');
    }
}
