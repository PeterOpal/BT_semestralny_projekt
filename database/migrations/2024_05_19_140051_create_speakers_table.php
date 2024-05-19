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
        Schema::create('speakers', function (Blueprint $table) {
            $table->id();
            $table->string('meno', length: 70);
            $table->binary('photo');
            $table->text('kratky_popis');
            $table->text('dlhy_popis');
            $table->string('facebook_link', length: 150);
            $table->string('twitter_link', length: 150);
            $table->string('web_link', length: 150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speakers');
    }
};
