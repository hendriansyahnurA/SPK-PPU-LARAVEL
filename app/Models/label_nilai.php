<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class label_nilai extends Model
{
    use HasFactory;

    protected $table = "label_nilai";
    protected $fillable = [
        "nama",
        "nilai",
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id');
    }
}
