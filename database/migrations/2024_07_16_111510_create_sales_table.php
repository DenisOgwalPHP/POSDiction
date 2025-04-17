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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ProductRefer'); 
            $table->float('Quantity'); 
            $table->float('Price');
            $table->float('Cost');
            $table->bigInteger('Payment_id'); 
            $table->bigInteger('Account_id');
            $table->String('Cleared')->default('Not Cleared');    
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
        Schema::dropIfExists('sales');
    }
};
