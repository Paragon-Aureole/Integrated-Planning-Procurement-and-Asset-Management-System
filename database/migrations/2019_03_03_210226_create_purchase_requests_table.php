<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ppmp_id')->unsigned()->index()->nullable();
            $table->integer('signatory_id')->unsigned()->index()->nullable();
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->integer('office_id')->unsigned()->index()->nullable();
            $table->string('pr_code');
            $table->decimal('pr_budget');
            $table->integer('supplier_type');
            $table->integer('supplier_id')->nullable();
            $table->boolean('pr_status')->default(0);
            $table->boolean('created_supplemental')->default(0);
            $table->boolean('created_rfq')->default(0);
            $table->boolean('created_abstract')->default(0);
            $table->boolean('created_po')->default(0);
            $table->boolean('created_inspection')->default(0);
            $table->timestamps();
        });

        Schema::table('purchase_requests', function($table) {
            $table->foreign('ppmp_id')->references('id')->on('ppmps')->onDelete('cascade');
            $table->foreign('signatory_id')->references('id')->on('signatories');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('purchase_requests');
    }
}
