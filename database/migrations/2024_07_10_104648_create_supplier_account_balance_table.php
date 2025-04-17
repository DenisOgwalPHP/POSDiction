<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_account_balance', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('AccountID');  
            $table->string('TransactionType')->default('Deposit'); 
            $table->integer('Amount'); 
            $table->integer('Duepayment'); 
            $table->integer('AccountBalance'); 
            $table->string('PaymentMode')->default('Cash'); 
            $table->bigInteger('User_id');        
            $table->bigInteger('Branch');
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
        Schema::dropIfExists('supplier_account_balance');
    }
};
