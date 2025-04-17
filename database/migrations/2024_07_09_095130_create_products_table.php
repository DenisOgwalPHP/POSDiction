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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->String('ProductName'); 
            $table->String('Manufacturer'); 
            $table->String('Units');
            $table->String('SellingUnits');
            $table->float('PurchaseCost'); 
            $table->float('SellingPrice'); 
            $table->String('Origin');
            $table->String('Weight');
            $table->String('Barcode');
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
        Schema::dropIfExists('products');
    }
};
