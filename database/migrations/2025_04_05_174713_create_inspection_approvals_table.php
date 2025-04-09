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
        Schema::create('inspection_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspection_id')->constrained()->onDelete('cascade'); // Relasi ke inspections
            $table->foreignId('supervisor_id')->constrained('users')->onDelete('cascade'); // Relasi ke users (supervisor)
            $table->enum('status', ['Approved', 'Rejected', 'Pending'])->default('Pending');
            $table->text('notes')->nullable(); // Catatan dari supervisor
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_approvals');
    }
};
