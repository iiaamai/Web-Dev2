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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('lastname', 50);
            $table->string('firstname', 50);
            $table->string('province', 50);
            $table->string('country', 50);
            $table->string('school', 50);
            $table->string('program', 10);
            $table->string('program_major', 50);
            $table->unsignedTinyInteger('year');
            $table->string('status', 20)->default('regular');
            $table->date('birthday');
            $table->json('subjects')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
