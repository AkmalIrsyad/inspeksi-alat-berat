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
        Schema::create('alat_berats', function (Blueprint $table) {
            $table->id();
            $table->string('merk');
            $table->integer('serial_number');
            $table->enum('jenis', ['Excavator', 'Bulldozer','Crane','Wheel Loader','Forklift','Grader','Dump Truck','Paver','Roller Compactor']);
            $table->text('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat_berats');
    }
};
