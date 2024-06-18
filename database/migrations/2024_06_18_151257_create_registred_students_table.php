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
        Schema::create('registred_students', function (Blueprint $table) {
            $table->id();
            $table->string('meno');
            $table->string('priezvisko');
            $table->string('skola', 50)->default(null);
            $table->string('mail')->unique();
            $table->string('token');
            $table->tinyInteger('actived')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registred_students');
    }
};
