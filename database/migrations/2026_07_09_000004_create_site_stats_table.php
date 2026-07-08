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
        Schema::create('site_stats', function (Blueprint $t) {
            $t->id();
            $t->string('nilai');
            $t->string('label');
            $t->unsignedInteger('sort_order')->default(0);
            $t->boolean('is_published')->default(true);
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_stats');
    }
};
