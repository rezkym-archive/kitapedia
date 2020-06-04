<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionSosmedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_sosmed', function (Blueprint $table) {
            $table->id();
            $table->string('sosmed_id')->nullable(false);
            $table->string('tid');
            $table->string('username');  
            $table->mediumText('service')->default('Service Undefined'); 
            $table->mediumText('type')->default('Type Undefined'); 
            $table->mediumText('target')->default('Target Not Found'); 
            $table->integer('qty')->nullable()->default(0); 
            $table->integer('count')->nullable()->default(0); 
            $table->integer('remain')->nullable()->default(0); 
            $table->string('price')->nullable()->default('0'); 
            $table->string('reff')->nullable()->default('0'); 
            $table->enum('status', ['success', 'pending', 'error'])->nullable()->default('pending');
            $table->string('refund')->nullable()->default('no'); 
            $table->string('place')->nullable()->default('Order Place Undefined'); 
            $table->string('provider')->nullable()->default('Provider Undefined'); 
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
        Schema::dropIfExists('transaction_sosmed');
    }
}
