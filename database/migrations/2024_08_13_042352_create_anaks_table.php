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
        Schema::create('anaks', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->nullable();
            $table->string('nama');
            $table->string('nm_ayah');
            $table->string('jk');
            $table->date('tgl_lahir');
            $table->decimal('bb_lahir', 4, 2);
            $table->decimal('tb_lahir', 4, 2);
            $table->string('anak_ke');
            $table->string('jns_persalinan');
            $table->foreignId('ibu_id')->constrained('ibus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anaks');
    }
};
