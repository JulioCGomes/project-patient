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
        Schema::create('address_patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('cep', 9);
            $table->string('address', 30);
            $table->integer('number');
            $table->string('complement', 20)->nullable();
            $table->string('neighborhood', 30);
            $table->string('city', 30);
            $table->string('state', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_patients');
    }
};
