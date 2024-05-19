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
        Schema::create('stage_programs', function (Blueprint $table) {
            $table->id();
            $table->string('cas', length: 10);
            $table->string('nazov_prednasky', length: 50);
            $table->text('popis');
            $table->integer('stage_id');
            $table->integer('speaker_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stage_programs');
    }
};
