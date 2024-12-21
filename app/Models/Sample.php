<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;
    protected $table = "sample";

    protected $fillable = ['id_alternatif', 'id_faktor_nilai'];


    public function faktorNilai()
    {
        return $this->belongsTo(Nilai_Kriteria::class, 'id_faktor_nilai', 'id');
    }
}
