<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aspek extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'aspek';
    protected $dates = ['deleted_at'];

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