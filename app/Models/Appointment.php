<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 
        'date',
        'status',
        'is_deleted',
    ];

    protected $dates = ['date'];

     // Define relationships or other methods here

     public function patient()
     {
         return $this->belongsTo(Patient::class);
     }

     public function motifs()
    {
        return $this->hasMany(Motifs::class);
    }


}
