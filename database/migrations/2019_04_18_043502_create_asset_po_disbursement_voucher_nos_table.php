<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetPoDisbursementVoucherNosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_po_disbursement_voucher_nos', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('purchase_order_id')->unsigned()->nullable()->index();
			$table->string('disbursementNo')->default('0');
            $table->double('amount', 15, 2);
            $table->timestamps();

            $table->foreign('purchase_order_id')->references('purchase_order_id')->on('assets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_po_disbursement_voucher_nos');
    }
}
