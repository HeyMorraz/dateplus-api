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
        Schema::create('dating', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('hour');
            $table->string('observation');
            $table->foreignId('users_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('clients_id')->constrained('clients')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dating');
    }
};
