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
    Schema::table('maintenances', function (Blueprint $table) {
        $table->date('next_service_date')->nullable()->after('service_date');
    });
}

public function down(): void
{
    Schema::table('maintenances', function (Blueprint $table) {
        $table->dropColumn('next_service_date');
    });
}
};