<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pm_bobot extends Model
{
    use HasFactory;

    protected $table = "pm_bobot";

    protected $fillable = [
        "selisih",
        "bobot",
        "keterangan",
    ];
}
