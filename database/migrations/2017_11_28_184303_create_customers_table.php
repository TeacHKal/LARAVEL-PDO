<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('gender');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('country');
            $table->string('email');
            $table->float('current_amount', 10, 2);
            $table->float('bonus_amount', 10, 2);
            $table->float('total_deposit_amount', 10, 2);
            $table->float('total_withdrawal_amount', 10, 2);
            $table->integer('no_of_deposits');
            $table->integer('no_of_withdrawals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
