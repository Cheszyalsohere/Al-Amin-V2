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
        Schema::create('leads', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('nama', 80);
            $table->string('no_hp', 20);
            $table->string('no_hp_ortu', 20);
            $table->string('email')->nullable();
            $table->string('asal_sekolah', 120)->nullable();
            $table->string('kelas', 24);
            $table->string('program_minat')->nullable(); // nullable at DB level for manually-created leads; public form requires it (see StoreLeadRequest)
            $table->string('sumber')->index();
            $table->string('status')->default('baru')->index();
            $table->text('catatan')->nullable();
            $table->string('utm_source')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('contacted_at')->nullable();
            $table->timestamp('converted_at')->nullable();
            $table->timestamps();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
