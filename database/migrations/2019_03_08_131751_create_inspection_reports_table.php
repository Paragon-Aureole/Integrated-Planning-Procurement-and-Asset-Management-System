<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspectionReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_request_id')->unsigned()->nullable()->index();
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->string('invoice_number', 100)->nullable()->default('-');
            $table->string('property_officer', 100)->nullable();
            $table->string('inspection_officer', 100)->nullable()->default('-');
            $table->string('issuing_officer', 100)->nullable()->default('-');
            $table->string('issuing_officer_position', 100)->nullable()->default('-');
            $table->timestamps();
        });

        Schema::table('inspection_reports', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('purchase_request_id')->references('id')->on('purchase_requests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_reports');
    }
}
