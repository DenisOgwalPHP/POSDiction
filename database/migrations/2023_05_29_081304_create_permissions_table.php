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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('UserGroup');
            $table->string('Settings')->nullable();
            $table->string('AccountCreation')->nullable();
            $table->string('AccountUpdate')->nullable();
            $table->string('AccountDelete')->nullable();
            $table->string('AccountRecords')->nullable();
            $table->string('PaymentRecords')->nullable();
            $table->string('AccountReports')->nullable();
            $table->string('PaymentReports')->nullable();
            $table->string('UserSearch')->nullable();
            $table->string('StockBalance')->nullable();
            $table->string('Expenses')->nullable();
            $table->string('Attendance')->nullable();
            $table->string('SalesSummary')->nullable();
            $table->string('SalesRecords')->nullable();
            $table->string('AddPurchases')->nullable();
            $table->string('ClientAccount')->nullable();
            $table->string('ClearCreditors')->nullable();
            $table->string('HumanResource')->nullable();
            $table->string('Records')->nullable();
            $table->string('Reports')->nullable();
            $table->string('Prices')->nullable();
            $table->string('MoneyTransfer')->nullable();
            $table->string('PlantAndMachinery')->nullable();
            $table->string('Delete')->nullable();
            $table->string('Update')->nullable();
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
        Schema::dropIfExists('permissions');
    }
};