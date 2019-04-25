<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetParsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_pars', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('purchase_order_id')->unsigned()->nullable()->index();
            $table->integer('asset_id')->unsigned()->nullable()->index();
            $table->integer('quantity');
            $table->string('description')->default('N/A');
            $table->string('property_no')->nullable()->default('');
            $table->string('assignedTo');
            $table->string('position');
            $table->timestamps();
        });

        Schema::table('asset_pars', function (Blueprint $table) {
            // $table->foreign('purchase_order_id')->references('purchase_order_id')->on('assets')->onDelete('cascade');
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
        });

        Schema::table('disbursement_vouchers', function (Blueprint $table) {
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');
        });

        Schema::table('assets', function (Blueprint $table) {
            $table->foreign('measurement_unit_id')->references('id')->on('measurement_units')->onDelete('cascade');
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');
            $table->foreign('asset_type_id')->references('id')->on('asset_types')->onDelete('cascade');
        });

        Schema::table('edit_assets', function (Blueprint $table) {
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
        });

        Schema::table('edit_distributed_assets', function (Blueprint $table) {
            $table->foreign('par_id')->references('id')->on('asset_pars')->onDelete('cascade');
            $table->foreign('ics_id')->references('id')->on('asset_icslips')->onDelete('cascade');
        });

        Schema::table('asset_turnovers', function (Blueprint $table) {
            $table->foreign('par_id')->references('id')->on('asset_pars')->onDelete('cascade');
            $table->foreign('ics_id')->references('id')->on('asset_icslips')->onDelete('cascade');
        });

        Schema::table('asset_icslips', function (Blueprint $table) {
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
        });

        Schema::table('migrated_assets', function (Blueprint $table) {
            $table->foreign('asset_type_id')->references('id')->on('asset_types')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_pars');
    }
}
