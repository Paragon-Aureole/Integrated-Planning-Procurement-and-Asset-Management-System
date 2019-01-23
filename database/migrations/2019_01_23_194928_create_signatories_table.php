<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignatoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signatories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('office_id')->unsigned()->index()->nullable();
            $table->string('signatory_name');
            $table->string('signatory_position');
            $table->integer('category');
            $table->boolean('is_activated')->default(0);
        });

        Schema::table('signatories', function($table) {
            $table->softDeletes();
            $table->foreign('office_id')->references('id')->on('offices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signatories');
    }
}
