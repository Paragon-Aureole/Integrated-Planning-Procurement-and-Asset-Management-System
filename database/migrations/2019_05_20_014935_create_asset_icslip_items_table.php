<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetIcslipItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_icslip_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asset_icslip_id')->unsigned()->nullable()->index();
            $table->integer('asset_id')->unsigned()->nullable()->index();
            $table->integer('quantity');
            $table->string('description');
            $table->string('assignedTo');
            $table->string('position');
            $table->string('inventory_name_no')->nullable()->default('');
            $table->string('useful_life');
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

        Schema::table('asset_icslip_items', function (Blueprint $table) {
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
            $table->foreign('asset_icslip_id')->references('id')->on('asset_icslips')->onDelete('cascade');
        });

        Schema::table('asset_icslips', function (Blueprint $table) {
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');
        });

        Schema::table('migrated_assets', function (Blueprint $table) {
            $table->foreign('asset_type_id')->references('id')->on('asset_types')->onDelete('cascade');
        });

        Schema::table('asset_turnovers', function (Blueprint $table) {
            $table->foreign('asset_par_id')->references('id')->on('asset_pars')->onDelete('cascade');
        });

        Schema::table('asset_turnover_items', function (Blueprint $table) {
            $table->foreign('asset_turnover_id')->references('id')->on('asset_turnovers')->onDelete('cascade');
            $table->foreign('asset_par_item_id')->references('id')->on('asset_par_items')->onDelete('cascade');
        });

        // Schema::table('asset_turnovers', function (Blueprint $table) {
        //     $table->foreign('asset_par_item_id')->references('id')->on('asset_par_items')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_icslip_items');
    }
}
