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
        Schema::create('asset_register', function (Blueprint $table) {
            $table->id();
            $table->string('Year');
            $table->string('Term');
            $table->string('ProductName');
            $table->integer('Quantity');
            $table->string('Units');
            $table->integer('UnitCost');
            $table->bigInteger('Supplier')->unsigned();
            $table->longText('Description');
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
        Schema::dropIfExists('asset_register');
    }
};
