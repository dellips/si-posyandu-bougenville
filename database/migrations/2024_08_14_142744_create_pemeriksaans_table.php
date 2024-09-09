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
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->decimal('bb', 6, 2);
            $table->decimal('tb', 6, 2);
            $table->decimal('lk', 6, 2)->nullable();
            $table->decimal('pl', 6, 2)->nullable();
            $table->decimal('lila', 6, 2)->nullable();
            $table->decimal('lp', 6, 2)->nullable();
            $table->integer('sistolik')->nullable();
            $table->integer('diastolik')->nullable();
            $table->string('vit_a')->nullable()->default('-');
            $table->string('obat_cacing')->nullable()->default('-');
            $table->string('tambah_darah')->nullable()->default('-');
            $table->string('bulan_ke')->nullable()->default('-');
            $table->string('ket')->nullable()->default('-');
            $table->foreignId('sasaran_id')->nullable()->constrained('sasarans')->onDelete('cascade');
            $table->foreignId('anak_id')->nullable()->constrained('anaks')->onDelete('cascade');
            $table->foreignId('kegiatan_id')->constrained('kegiatans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
