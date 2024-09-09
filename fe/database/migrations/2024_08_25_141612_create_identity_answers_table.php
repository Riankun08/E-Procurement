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
        Schema::create('identity_answers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('form_id')->nullable();
            $table->string('building_name' , 100)->nullable();
            $table->string('consultant' , 100)->nullable();
            $table->date('post_date')->nullable();
            $table->timestamps();

            $table->foreign('form_id')
            ->references('id')
            ->on('forms')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identity_answers');
    }
};
