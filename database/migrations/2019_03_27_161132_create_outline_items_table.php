<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutlineItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outline_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('outline_id')->unsigned()->nullable()->index();
            $table->integer('pr_item_id')->unsigned()->nullable()->index();
            $table->timestamps();
        });

        Schema::table('outline_items', function (Blueprint $table) {
            $table->foreign('outline_id')->references('id')->on('outline_of_quotations')->onDelete('cascade');
            $table->foreign('pr_item_id')->references('id')->on('purchase_request_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outline_items');
    }
}
