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
        Schema::create('cash_flow_balances', function (Blueprint $table) {
            
            $table->uuid('id')->primary();
            $table->double('balance', 8,2)->default(0);
            $table->foreignUuid('cash_flow_id')->constrained('cash_flows');
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
        Schema::dropIfExists('cash_flow_balances');
    }
};
