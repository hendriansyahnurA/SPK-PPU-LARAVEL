<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kriteria extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "kriteria";
    protected $dates = ['deleted_at'];


    protected $fillable = [
        "id_aspek",
        "kriteria",
        "type",
        "id_nilai",
    ];
    public function nilai()
    {
        return $this->belongsTo(label_nilai::class, 'id_nilai');
    }

    public function aspek()
    {
        return $this->belongsTo(Aspek::class, 'id_aspek', 'id');
    }

    public function pm_kriteria_nilai()
    {
        return $this->hasMany(Nilai_Kriteria::class, 'id_kriteria');
    }
}