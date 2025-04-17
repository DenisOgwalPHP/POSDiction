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
        Schema::create('client_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('AccountName');
            $table->string('AccountName2');
            $table->string('ContactNo');
            $table->string('ContactNo2');
            $table->string('Gender');
            $table->string('District');
            $table->string('Village');
            $table->string('TINnumber');
            $table->string('Location');
            $table->string('Model');
            $table->string('Received');
            $table->string('Branch');
            $table->longText('Description');
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
        Schema::dropIfExists('client_accounts');
    }
};
