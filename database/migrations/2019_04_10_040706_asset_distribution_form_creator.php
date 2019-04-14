<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class assetDistributionFormCreator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('asset_distribution_form_creators', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('PAR_id');
			$table->integer('assets_id');
			$table->string('inputSignatory');
			$table->boolean('isProvisioned');
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
