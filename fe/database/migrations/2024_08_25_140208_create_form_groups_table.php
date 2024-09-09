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
        Schema::create('form_groups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('form_id')->nullable();
            $table->uuid('element_id')->nullable();
            $table->uuid('formula_id')->nullable();
            $table->string('title' , 255)->nullable();
            $table->integer('sequence')->default(0);
            $table->timestamps();

            $table->foreign('form_id')
            ->references('id')
            ->on('forms')
            ->onDelete('cascade');

            $table->foreign('formula_id')
            ->references('id')
            ->on('formulas')
            ->onDelete('cascade');

            $table->foreign('element_id')
            ->references('id')
            ->on('elements')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_groups');
    }
};
