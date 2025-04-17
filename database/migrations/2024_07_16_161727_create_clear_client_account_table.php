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
        Schema::create('clear_client_account', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ClientAccount');  
            $table->String('TransationType'); 
            $table->bigInteger('ClearedTransaction');
            $table->float('Amount');
            $table->float('AccountBalance');
            $table->longText('Description'); 
            $table->bigInteger('PaymentMethod'); 
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
        Schema::dropIfExists('clear_client_account');
    }
};
