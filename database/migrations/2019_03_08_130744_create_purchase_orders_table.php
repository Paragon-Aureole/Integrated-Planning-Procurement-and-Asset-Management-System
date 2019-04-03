<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_request_id')->unsigned()->nullable()->index();
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->integer('outline_supplier_id')->unsigned()->nullable()->index();
            $table->integer('procurement_mode_id')->unsigned()->nullable()->index();
            $table->string('supplier_tin', 12)->nullable()->default('-');
            $table->string('delivery_place', 100)->nullable()->default('GSO');
            $table->date('delivery_date')->nullable();
            $table->string('delivery_term', 100)->nullable()->default('-');
            $table->string('payment_term', 100)->nullable()->default('-');
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
        Schema::dropIfExists('purchase_orders');
    }
}
