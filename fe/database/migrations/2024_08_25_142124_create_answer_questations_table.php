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
        Schema::create('answer_questations', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('identity_answer_id')->nullable();
            $table->uuid('form_questions_id')->nullable();
            $table->string('answer' , 100)->nullable();
            $table->text('textarea')->nullable();
            $table->text('document')->nullable();
            $table->text('image')->nullable();
            $table->timestamps();

            $table->foreign('identity_answer_id')
            ->references('id')
            ->on('identity_answers')
            ->onDelete('cascade');

            $table->foreign('form_questions_id')
            ->references('id')
            ->on('form_questions')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_questations');
    }
};
