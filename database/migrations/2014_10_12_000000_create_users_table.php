<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->unsigned()->nullable();            
            $table->foreign('parent_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('nohp')->nullable();
            $table->string('username');
            $table->string('password');
            $table->integer('balance')->nullable();
            $table->enum('role', ['admin', 'reseller', 'client'])->default('client');
            $table->enum('status', ['active', 'nonactive', 'suspended', 'deleted'])->default('nonactive');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletesTz('deleted_at', 0);	
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
