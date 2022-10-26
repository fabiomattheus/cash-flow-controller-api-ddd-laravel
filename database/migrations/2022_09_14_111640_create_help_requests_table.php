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
        Schema::create('help_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('identifier');
            $table->enum('status',['opened', 'analyzing', 'exchanging', 'carrying', 'reject', 'closed']);
            $table->foreignUuid('help_id')->constrained('helps');
            $table->foreignUuid('requester_id')->constrained('requesters');
            $table->foreignUuid('purchase_item_id')->constrained('purchase_items');
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
        Schema::dropIfExists('help_requests');
    }
};
