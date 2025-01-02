<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peserta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'peserta';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        "nama",
        'jenis_kelamin',
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