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
       Schema::create('services', function (Blueprint $table) {
    $table->id();

    $table->foreignId('vehicle_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->date('service_date');
    $table->string('register_number')->nullable();
    $table->integer('km_service')->default(0);
    $table->date('next_service_date')->nullable();
    $table->text('memo')->nullable();

    $table->decimal('total_cost', 15, 2)->default(0);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
