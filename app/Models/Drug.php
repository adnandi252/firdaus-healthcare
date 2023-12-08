<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;

    protected $fillable = [
        'drug_name',
        'price',
        'type',
        'description',
        'netto',
    ];
    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
