<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppmps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->integer('office_id')->unsigned()->index()->nullable();
            $table->integer('signatory_id')->unsigned()->index()->nullable();
            $table->year('ppmp_year');
            $table->boolean('is_active')->default(0);
            $table->boolean('is_supplemental')->default(0);
            $table->boolean('is_printed')->default(0);
            $table->integer('former_ppmp_id')->unsigned()->nullable();
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
        Schema::dropIfExists('ppmps');
    }
}
