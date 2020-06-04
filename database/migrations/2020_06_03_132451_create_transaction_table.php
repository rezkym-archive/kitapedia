<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();            
            $table->foreign('user_id')->references('id')->on('transaction')->onUpdate('set null')->onDelete('set null');
            $table->bigInteger('ppob_id')->nullable(true);
            $table->bigInteger('sosmed_id')->nullable(true);
            $table->string('username', 100)->nullable()->default('text');
            $table->string('type', 100)->nullable()->default('unknown');
            $table->string('status', 100)->nullable()->default('pending');
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}
