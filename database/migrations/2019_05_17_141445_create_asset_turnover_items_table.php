<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetTurnoverItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_turnover_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asset_turnover_id')->unsigned()->nullable()->index();
            $table->integer('asset_par_item_id')->unsigned()->nullable()->index();
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

        Schema::table('asset_icslips', function (Blueprint $table) {
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
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
        Schema::dropIfExists('asset_turnover_items');
    }
}
