<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceNoteDetail extends Model
{
    protected $fillable = [
        'service_note_id',
        'spare_part_id',
    ];

    public function serviceNote()
    {
        return $this->belongsTo(ServiceNote::class);
    }

    public function sparePart()
    {
        return $this->belongsTo(SparePart::class);
    }
}
