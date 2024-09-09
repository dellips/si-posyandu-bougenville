<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');  // Disable foreign key checks


        Schema::create('anaks', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->nullable();
            $table->string('nama');
            $table->string('nm_ayah');
            $table->string('jk');
            $table->date('tgl_lahir');
            $table->decimal('bb_lahir', 4, 2);
            $table->decimal('tb_lahir', 4, 2);
            $table->string('jns_persalinan');
            $table->string('jns_kelahiran');
            $table->foreignId('sasaran_id')->nullable()->constrained('sasarans')->onDelete('cascade');
            $table->timestamps();
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');  // Enable foreign key checks

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');  // Disable foreign key checks

        Schema::dropIfExists('anaks');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');  // Enable foreign key checks

    }
};
