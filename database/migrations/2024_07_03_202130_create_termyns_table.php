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
        Schema::create('termyns', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->decimal('progress');
            $table->date('date_created');
            $table->boolean('is_approve')->default(true);
            $table->date('date_approved');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('termyns');
    }
};
