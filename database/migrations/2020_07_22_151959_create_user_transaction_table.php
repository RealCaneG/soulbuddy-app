<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->nullable();
            $table->double('amount');
            $table->string('ccy')->nullable();
            $table->string('payment_method');
            $table->integer('transaction_type');
            $table->integer('status');
            $table->string('intent')->nullable();
            $table->string('country_code')->nullable();
            $table->unsignedInteger('to_user_id');
            $table->string('merchant_id')->nullable();
            $table->string('payee_email')->nullable();
            $table->string('payer_id');
            $table->string('payer_email')->nullable();
            $table->string('given_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('reference_id')->nullable();
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
        Schema::dropIfExists('user_transactions');
    }
}
