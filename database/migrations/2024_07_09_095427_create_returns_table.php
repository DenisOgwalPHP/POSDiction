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
        Schema::create('returns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ProductRefer'); 
            $table->date('ReturnDate'); 
            $table->bigInteger('SupplierID');
            $table->String('Origin');
            $table->String('Weight');
            $table->float('Quantity'); 
            $table->String('Units');
            $table->String('Reason');
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
        Schema::dropIfExists('returns');
    }
};
