<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutlineItemPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outline_item_prices', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('outline_id')->unsigned()->nullable()->index();
            $table->integer('outline_supplier_id')->unsigned()->nullable()->index();
            $table->integer('pr_item_id')->unsigned()->nullable()->index();
            // $table->integer('outline_item_id')->unsigned()->nullable()->index();
            $table->double('final_cpu', 15, 2)->nullable()->default(0.00);
            $table->double('final_cpi', 15, 2)->nullable()->default(0.00);
            $table->timestamps();
        });

        Schema::table('outline_item_prices', function (Blueprint $table) {
            // $table->foreign('outline_id')->references('id')->on('outline_of_quotations`')->onDelete('cascade');
            $table->foreign('outline_supplier_id')->references('id')->on('outline_suppliers')->onDelete('cascade');
            // $table->foreign('outline_item_id')->references('id')->on('outline_items')->onDelete('cascade');
            $table->foreign('pr_item_id')->references('id')->on('purchase_request_items')->onDelete('cascade');
        });

        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('purchase_request_id')->references('id')->on('purchase_requests')->onDelete('cascade');
            $table->foreign('outline_supplier_id')->references('id')->on('outline_suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outline_item_prices');
    }
}
