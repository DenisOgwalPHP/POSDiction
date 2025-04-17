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
        Schema::create('sales_return', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('SalesRefer'); 
            $table->bigInteger('ProductRefer'); 
            $table->float('Quantity'); 
            $table->float('PriceRate');
            $table->float('CostRate');
            $table->bigInteger('ClientAccount');
            $table->longText('Reason');
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
        Schema::dropIfExists('sales_return');
    }
};
