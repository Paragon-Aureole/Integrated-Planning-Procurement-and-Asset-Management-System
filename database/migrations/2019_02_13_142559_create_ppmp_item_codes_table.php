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
            $table->integer('ppmp_id')->unsigned()->index()->nullable();
            $table->string('code_description');
            $table->integer('code_type')->nullable();
        });

        Schema::table('ppmp_item_codes', function($table) {
            $table->foreign('ppmp_id')->references('id')->on('ppmps');
        });

        Schema::table('ppmp_budgets', function($table) {
            $table->foreign('ppmp_id')->references('id')->on('ppmps');
        });

        Schema::table('ppmps', function($table) {
            $table->foreign('ppmp_budget_id')->references('id')->on('ppmp_budgets');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('office_id')->references('id')->on('offices');
        });

        Schema::table('ppmp_items', function($table) {
            $table->foreign('ppmp_id')->references('id')->on('ppmps');
            $table->foreign('measurement_unit_id')->references('id')->on('procurement_modes');
            $table->foreign('procurement_mode_id')->references('id')->on('measurement_units');
            $table->foreign('ppmp_item_code_id')->references('id')->on('ppmp_item_codes');
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
