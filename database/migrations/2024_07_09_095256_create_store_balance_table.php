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
        Schema::create('store_balance', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ProductRefer'); 
            $table->date('BalanceDate'); 
            $table->String('Origin');
            $table->String('Weight');
            $table->float('ItemBalance'); 
            $table->String('Units');
            $table->integer('ProductValue');
            $table->integer('StockRate');
            $table->bigInteger('User_id');     
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
        Schema::dropIfExists('store_balance');
    }
};
