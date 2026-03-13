<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Kolom pembeda asal data (Admin atau Nota Dinas)
            $table->boolean('is_service_note')->default(false)->after('id');
            
            // Kolom pindahan dari service_notes
            $table->string('number')->nullable()->after('register_number');
            $table->string('cc')->nullable()->after('number');
            $table->text('introduction')->nullable()->after('cc');
            $table->string('position')->nullable()->after('introduction');
            $table->string('name')->nullable()->after('position');
            $table->string('nip')->nullable()->after('name');
            
            // Kolom is_approved di services sudah ada (dari screenshot kamu), 
            // jadi kita tidak perlu buat lagi.
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'is_service_note', 'number', 'cc', 
                'introduction', 'position', 'name', 'nip'
            ]);
        });
    }
};