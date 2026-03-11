<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = [
        'vehicle_id',
        'service_date',
        'mileage',
        'total_cost',
        'next_service_date',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function details()
    {
        return $this->hasMany(MaintenanceDetail::class);
    }
}
