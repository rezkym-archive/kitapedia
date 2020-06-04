<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionPpobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_ppob', function (Blueprint $table) {
            $table->id();
            $table->string('ppob_id')->nullable(false);
            $table->string('tid');
            $table->string('username');
            $table->string('service');
            $table->string('target');
            $table->string('price');
            $table->mediumText('note');
            $table->enum('status', ['success', 'pending', 'error'])->nullable()->default('pending');
            $table->enum('refund', ['yes', 'no'])->nullable()->default('no');
            $table->string('place')->nullable()->default('WEB');
            $table->string('provider')->default('GazzPay');
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
        Schema::dropIfExists('transaction_ppob');
    }
}
