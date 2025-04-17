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
        Schema::create('money_transfer', function (Blueprint $table) {
            $table->id();
            $table->integer('AmountTransfered'); 
            $table->bigInteger('TransferedFrom'); 
            $table->bigInteger('TransferedTo'); 
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
        Schema::dropIfExists('money_transfer');
    }
};
