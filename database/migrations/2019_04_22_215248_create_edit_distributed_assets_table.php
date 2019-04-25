<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditDistributedAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edit_distributed_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('par_id')->unsigned()->nullable()->index();
            $table->integer('ics_id')->unsigned()->nullable()->index();
            $table->string('reason');
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
        Schema::dropIfExists('edit_distributed_assets');
    }
}
