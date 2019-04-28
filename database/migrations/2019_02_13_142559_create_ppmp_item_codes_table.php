<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpmpItemCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppmp_item_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('office_id')->unsigned()->index()->nullable();
            $table->string('code_description');
            $table->integer('code_type')->nullable();
        });

        Schema::table('ppmp_item_codes', function($table) {
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
        });

        Schema::table('ppmp_budgets', function($table) {
            $table->foreign('ppmp_id')->references('id')->on('ppmps')->onDelete('cascade');
        });

        Schema::table('ppmps', function($table) {
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
        });

        Schema::table('ppmp_items', function($table) {
            $table->softDeletes();
            $table->foreign('ppmp_id')->references('id')->on('ppmps')->onDelete('cascade')->onDelete('cascade');
            $table->foreign('measurement_unit_id')->references('id')->on('measurement_units')->onDelete('cascade');
            $table->foreign('procurement_mode_id')->references('id')->on('procurement_modes')->onDelete('cascade');
            $table->foreign('ppmp_item_code_id')->references('id')->on('ppmp_item_codes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ppmp_item_codes');
    }
}
