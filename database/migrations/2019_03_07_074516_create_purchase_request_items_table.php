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
            $table->integer('ppmp_item_id')->unsigned()->index()->nullable();
            $table->integer('item_quantity');
            $table->decimal('item_cost', 15, 2);
            $table->decimal('item_budget', 15, 2);
            $table->timestamps();

        });

        Schema::table('purchase_request_items', function($table) {
            $table->softDeletes();
            $table->foreign('ppmp_item_id')->references('id')->on('ppmp_items')->onDelete('cascade');
            $table->foreign('purchase_request_id')->references('id')->on('purchase_requests')->onDelete('cascade');
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
