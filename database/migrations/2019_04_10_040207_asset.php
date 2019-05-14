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
            $table->integer('purchase_order_id')->unsigned()->index()->nullable();
            $table->integer('measurement_unit_id')->unsigned()->index()->nullable();
            $table->string('details');
            $table->double('amount', 15, 2);
            $table->integer('item_quantity');
            $table->integer('item_stock');
            $table->boolean('isICS')->nullable()->default(false);
            $table->boolean('isPAR')->nullable()->default(false);
            $table->integer('asset_type_id')->unsigned()->nullable()->index();
            $table->boolean('isAssigned')->nullable()->default(false);
            $table->boolean('isEditable')->nullable()->default(false);
            $table->boolean('isRequested')->nullable()->default(false);
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
        //
    }
}
