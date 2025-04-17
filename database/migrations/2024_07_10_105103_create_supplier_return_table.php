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
        Schema::create('supplier_return', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ProductID');
            $table->bigInteger('PurchaseID'); 
            $table->longText('Reason'); 
            $table->integer('Quantity'); 
            $table->bigInteger('SupplierID')->nullable(); 
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
        Schema::dropIfExists('supplier_return');
    }
};
