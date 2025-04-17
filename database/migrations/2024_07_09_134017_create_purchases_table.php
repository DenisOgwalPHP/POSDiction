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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ProductName'); 
            $table->bigInteger('Supplier');
            $table->date('PurchaseDate'); 
            $table->date('ManufactureDate'); 
            $table->date('ExpiryDate'); 
            $table->float('Quantity'); 
            $table->String('Units');
            $table->float('UnitCost'); 
            $table->float('TotalCost');
            $table->String('InvoiceNo');
            $table->float('QuantityLeft'); 
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
        Schema::dropIfExists('purchases');
    }
};
