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
        Schema::create('supplier_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('AccountID'); 
            $table->bigInteger('ProductID');
            $table->bigInteger('PurchaseID'); 
            $table->string('Reason'); 
            $table->integer('Amount'); 
            $table->string('Clearance')->default('Not Cleared'); 
            $table->bigInteger('ClearanceID')->nullable(); 
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
        Schema::dropIfExists('supplier_transactions');
    }
};
