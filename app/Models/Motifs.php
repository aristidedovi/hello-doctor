<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motifs extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id', 
        'date',
        'motif',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
