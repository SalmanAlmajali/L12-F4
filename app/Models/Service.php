<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
   protected $fillable = [
    'vehicle_id',
    'is_service_note', // Tambahkan ini
    'service_date',
    'register_number',
    'number',          // Tambahkan ini (Nomor Nota)
    'cc',              // Tambahkan ini
    'introduction',    // Tambahkan ini
    'position',        // Tambahkan ini
    'name',            // Tambahkan ini
    'nip',             // Tambahkan ini
    'km_service',
    'next_service_date',
    'memo',
    'total_cost',
    'is_approved',
];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function details()
    {
        return $this->hasMany(ServiceDetail::class);
    }

    public function updateTotalCost()
{
    $total = $this->details()->sum('total');
    $this->update(['total_cost' => $total]);
}
}