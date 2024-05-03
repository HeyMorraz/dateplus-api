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
        Schema::create('detailQuotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dating_id')->constrained('dating')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('services_id')->constrained('services')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailQuotes');
    }
};
