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
        Schema::create('staff_payment', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('StaffReference')->unsigned();
            $table->string('StaffID');
            $table->string('PaymentMonths');
            $table->string('PaymentYear');
            $table->string('PaymentDate');
            $table->integer('BasicSalary');
            $table->integer('SalaryPaid');
            $table->string('PaymentMethod');
            $table->longText('PaymentNotes');
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
        Schema::dropIfExists('staff_payment');
    }
};
