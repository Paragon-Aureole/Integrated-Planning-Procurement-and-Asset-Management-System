<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpmpBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppmp_budgets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ppmp_id')->unsigned()->index()->nullable();
            $table->decimal('ppmp_est_budget', 15, 2);
            $table->decimal('ppmp_rem_budget', 15, 2);
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
        Schema::dropIfExists('ppmp_budgets');
    }
}
