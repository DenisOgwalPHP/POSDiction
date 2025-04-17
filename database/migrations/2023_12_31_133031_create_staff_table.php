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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('StaffID');
            $table->string('StaffName');
            $table->string('Initials');
            $table->string('Gender');
            $table->string('Address');
            $table->string('PhoneNumber');
            $table->date('DOB');
            $table->string('Department');
            $table->string('Qualifications');
            $table->string('Designation');
            $table->string('Email');
            $table->string('BasicSalary');
            $table->string('AccountNo');
            $table->string('BankName');
            $table->string('OfficeNo');
            $table->string('StaffType');
            $table->bigInteger('UserAccount')->unsigned();
            $table->string('StaffProfilePic');
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
        Schema::dropIfExists('staff');
    }
};
