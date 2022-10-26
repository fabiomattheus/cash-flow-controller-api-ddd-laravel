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
        Schema::create('legal_persons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('corporate_name');
            $table->string('fantasy_name');
            $table->string('cnpj');
            $table->string('state_registration');
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
        Schema::dropIfExists('legal_persons');
    }
};
