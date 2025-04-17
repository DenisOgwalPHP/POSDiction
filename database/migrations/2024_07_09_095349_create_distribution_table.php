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
        Schema::create('distribution', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ProductRefer'); 
            $table->date('DistributionDate'); 
            $table->float('Quantity'); 
            $table->String('Units');
            $table->String('Flow');
            $table->String('Reason');
            $table->integer('ProductValue');
            $table->integer('StockRate');
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
        Schema::dropIfExists('distribution');
    }
};
