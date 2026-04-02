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
        Schema::create('action_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cloud_stack_id')->constrained()->onDelete('cascade');
            $table->foreignId('lead_agency_id')->nullable()->constrained('agencies');
            $table->text('activity');
            $table->text('measurement_indicator')->nullable();
            $table->text('implementation_target')->nullable();
            $table->string('duration')->nullable();
            $table->year('start_year')->nullable();
            $table->year('end_year')->nullable();
            $table->string('implementation_status')->default('pending');
            $table->timestamps();
        });

        Schema::create('action_plan_support', function (Blueprint $table) {
            $table->id();
            $table->foreignId('action_plan_id')->constrained()->onDelete('cascade');
            $table->foreignId('agency_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('action_plan_support');
        Schema::dropIfExists('action_plans');
    }



};

