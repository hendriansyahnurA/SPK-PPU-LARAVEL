<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai_Kriteria extends Model
{
    use HasFactory;

    protected $table = "pm_kriteria_nilai";
    protected $fillable = [
        "nama",
        "nilai",
    ];

    public function kriteria()
    {
        return $this->hasMany(Kriteria::class, "id_nilai");
    }

    public function faktor()
    {
        return $this->belongsTo(Kriteria::class, 'id');
    }
}
