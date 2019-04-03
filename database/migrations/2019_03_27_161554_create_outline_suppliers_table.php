<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutlineSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outline_suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('outline_id')->unsigned()->nullable()->index();
            $table->string('supplier_name', 100);
            $table->string('supplier_address', 100);
            $table->string('canvasser_name');
            $table->integer('canvasser_office')->unsigned()->nullable()->index();
            $table->boolean('supplier_status')->nullable()->default(false);
            $table->integer('status_reason')->unsigned()->nullable()->default(1);
            $table->timestamps();
        });

        Schema::table('outline_suppliers', function (Blueprint $table) {
            $table->foreign('outline_id')->references('id')->on('outline_of_quotations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outline_suppliers');
    }
}
