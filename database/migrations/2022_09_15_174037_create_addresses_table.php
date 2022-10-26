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
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('street');
            $table->string('district');
            $table->string('lat');
            $table->string('long');
            $table->string('zip_code');
            $table->string('number')->default('s/n');
            $table->string('complement');
            $table->string('city');
            $table->string('state');
            $table->enum('type', ['home', 'work', 'delivery']);
            $table->UuidMorphs('addressable');
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
        Schema::dropIfExists('addresses');
    }
};
