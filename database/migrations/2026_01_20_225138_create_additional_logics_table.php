<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('additional_logics', function (Blueprint $table) {
            $table->id();
            $table->string('module_name', 100);
            $table->string('param_name', 100);
            $table->string('attr1_val')->nullable();
            $table->string('attr2_val')->nullable();
            $table->string('attr3_val')->nullable();
            $table->timestamps();

            $table->unique(['module_name', 'param_name'], 'unique_module_param');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_logics');
    }
};
