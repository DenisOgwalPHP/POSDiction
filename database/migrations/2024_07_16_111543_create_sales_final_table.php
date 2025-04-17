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
        Schema::create('sales_final', function (Blueprint $table) {
            $table->id();
            $table->float('Discount'); 
            $table->float('Quantity'); 
            $table->float('Cash');
            $table->float('Balance');
            $table->float('Duepayment');
            $table->float('TotalAmount');
            $table->float('DiscountedTotal');
            $table->bigInteger('PaymentMethod');
            $table->bigInteger('ClientAccount');
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
        Schema::dropIfExists('sales_final');
    }
};
