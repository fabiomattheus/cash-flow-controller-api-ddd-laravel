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
        Schema::create('cash_flows', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('identifier', 80)->unique();
            $table->string('description', 200);
            $table->enum('type',['all','credit','debit']);
            $table->double('value', 8, 2)->default(0);
            $table->string('note', 500);
            $table->date('movimentation_date', 8,2);
            $table->foreignUuid('departament_id')->constrained('departaments');
            $table->foreignUuid('operation_type_id')->constrained('operation_types');
            $table->foreignUuid('employee_id')->constrained('employees');
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
        Schema::dropIfExists('cash_flows');
    }
};
