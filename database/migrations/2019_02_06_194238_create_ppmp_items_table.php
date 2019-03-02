<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpmpItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppmp_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ppmp_id')->unsigned()->index()->nullable();
            $table->integer('measurement_unit_id')->unsigned()->index()->nullable();
            $table->integer('procurement_mode_id')->unsigned()->index()->nullable();
            $table->integer('ppmp_item_code_id')->unsigned()->index()->nullable();
            $table->string('item_description');
            $table->integer('item_quantity');
            $table->decimal('item_cost', 15, 2);
            $table->decimal('item_budget', 15, 2);
            $table->string('item_schedule');
            $table->integer('item_stock');
            $table->decimal('item_rem_budget', 15, 2);
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
        Schema::dropIfExists('ppmp_items');
    }
}
