<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'vehicle_id',
        'service_date',
        'register_number',
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

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total_cost = $model->details->sum('total');
        });
    }
}