<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;

class GpsLog extends Model
{
    protected $fillable = [
        'license_plate',
        'latitude',
        'longitude',
        'logged_at',
    ];

    protected $casts = [
        'logged_at' => 'datetime',
    ];

     public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'license_plate', 'license_plate');
    }
}
