<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    protected $fillable = [
        'service_id',
        'spare_part_id',
        'price',
        'qty',
        'total',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function sparePart()
    {
        return $this->belongsTo(SparePart::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total = $model->price * $model->qty;
        });
    }
}