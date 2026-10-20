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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained('departments')->onDelete('restrict'); // Relasi ke departments
            $table->string('name'); // Nama pegawai[cite: 2]
            $table->string('position'); // Jabatan[cite: 2]
            $table->decimal('salary', 12, 2); // Gaji[cite: 2]
            $table->date('joined_at'); // Tanggal bergabung[cite: 2]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
