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
        Schema::create('inspeksi_komponen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspeksi_id')->constrained('inspeksis')->onDelete('cascade');
            $table->foreignId('komponen_id')->constrained('komponens')->onDelete('cascade');
            $table->string('status')->nullable(); // OK / NO
            $table->text('komentar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspeksi_komponen');
    }
};
