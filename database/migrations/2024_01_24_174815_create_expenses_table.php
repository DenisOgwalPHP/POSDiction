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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('Expense'); 
            $table->string('ExpenseCategory'); 
            $table->date('ExpenseDate'); 
            $table->integer('ExpenseCost'); 
            $table->integer('ExpensePaid'); 
            $table->longText('Description'); 
            $table->bigInteger('PaymentMethod'); 
             $table->bigInteger('InputUser')->unsigned(); 
             $table->string('Year'); 
             $table->string('Months'); 
             $table->string('Branch');
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
        Schema::dropIfExists('expenses');
    }
};
