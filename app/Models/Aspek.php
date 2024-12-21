<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspek extends Model
{
    use HasFactory;

    protected $table = 'aspek';

    protected $fillable = [
        "aspek_penilaian",
        "presentase",
        "core_faktor",
        "secondary_faktor",
    ];

    public function kriteria()
    {
        return $this->hasMany(Kriteria::class, 'id_aspek');
    }
}
