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
        'is_approved',
    ];

    /**
     * Memberikan nilai default agar database tidak komplain 
     * jika field tidak dikirim dari form (terutama untuk Nota Dinas).
     */
    protected $attributes = [
        'price' => 0,
        'qty' => 1,
        'total' => 0,
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

        // Hitung total harga per baris sebelum disimpan
        static::saving(function ($model) {
            $model->total = ($model->price ?? 0) * ($model->qty ?? 1);
        });

        // Update total_cost di tabel Service (induk) setelah data detail tersimpan
        static::saved(function ($model) {
            if ($model->service) {
                $model->service->updateTotalCost();
            }
        });

        // Update total_cost di tabel Service (induk) setelah data detail dihapus
        static::deleted(function ($model) {
            if ($model->service) {
                $model->service->updateTotalCost();
            }
        });
    }
}