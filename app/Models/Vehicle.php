<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GpsLog;
use App\Models\Brand;
use App\Models\VehicleType;
use App\Models\Directorate;
use App\Models\Position;
use App\Models\Maintenance;
use App\Models\VehicleCost;

class Vehicle extends Model
{
    protected $fillable = [
        'vehicle_type_id',
        'brand_id',
        'directorate_id',
        'position_id',

        'license_plate',
        'chassis_number',
        'engine_number',
        'model',
        'color',
        'purchase_year',

        'acquisition_value',

        'stnk_due_date',
        'stnk_cost',
        'stnk_5_year_due_date',
        'stnk_5_year_cost',

        'bast_number',
        'bast_date',

        'user_phone',

        'body_condition',
        'engine_condition',

        'memo',

        'has_kir',
        'has_insurance',
        'is_locked',
        'is_active',
    ];

    /* ======================
     | RELATIONSHIPS
     |====================== */

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function directorate()
    {
        return $this->belongsTo(Directorate::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function costs()
    {
        return $this->hasMany(VehicleCost::class);
    }

   public function latestGps()
{
    // Kita kasih tahu Laravel: "Cari di gps_logs, hubungkan license_plate di sana dengan license_plate di sini"
    return $this->hasOne(GpsLog::class, 'license_plate', 'license_plate')->latestOfMany();
}
}
