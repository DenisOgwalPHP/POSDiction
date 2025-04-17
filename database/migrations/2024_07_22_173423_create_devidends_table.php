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
        Schema::create('devidends', function (Blueprint $table) {
            $table->id();
            $table->integer('Amount'); 
            $table->bigInteger('Withdrew_By'); 
            $table->bigInteger('User_id'); 
            $table->bigInteger('Branch'); 
            $table->longText('Reason'); 
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
        Schema::dropIfExists('devidends');
    }
};
