<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $table = 'peserta';

    protected $fillable = [
        "nama",
        "nim",
        "prodi",
        "semester",
        "ipk",
    ];
    public function sample()
    {
        return $this->hasMany(Sample::class, 'id_alternatif', 'id');
    }
}
