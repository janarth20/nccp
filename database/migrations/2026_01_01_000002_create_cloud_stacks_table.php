<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cloud_stacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pillar_id')->constrained()->onDelete('cascade');
            $table->integer('stack_number'); // CS1, CS2, etc. [cite: 131, 144, 157]
            $table->string('title');        // e.g., Centralised Govt Cloud Infrastructure [cite: 167]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cloud_stacks');
    }
};
