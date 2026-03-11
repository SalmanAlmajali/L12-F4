<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceNote extends Model
{
    protected $fillable = [
        'vehicle_id',
        'date',
        'number',
        'cc',
        'introduction',
        'position',
        'name',
        'nip',
        'approved',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function details()
    {
        return $this->hasMany(ServiceNoteDetail::class);
    }
    public function spareParts()
{
    return $this->belongsToMany(
        SparePart::class,
        'service_note_details'
    );
}
}
