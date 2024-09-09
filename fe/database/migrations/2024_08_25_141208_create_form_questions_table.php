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
        Schema::create('form_questions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('form_group_id')->nullable();
            $table->string('questions' , 255)->nullable();
            $table->text('regulation')->nullable();
            $table->enum('statement' , ['image' , 'textarea' , 'document' , 'file-textarea'])->default('textarea');
            // 'image-textarea', 'document-textarea'
            $table->integer('sequence')->default(0);
            
            $table->foreign('form_group_id')
            ->references('id')
            ->on('form_groups')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_questions');
    }
};
