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
        Schema::create('service_notes', function (Blueprint $table) {
            $table->id();

    $table->foreignId('vehicle_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->date('date');
    $table->string('number')->nullable();
    $table->string('cc')->nullable();
    $table->text('introduction')->nullable();
    $table->string('position')->nullable();
    $table->string('name')->nullable();
    $table->string('nip')->nullable();
    $table->boolean('approved')->default(false);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_notes');
    }
};
