<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class klasifikasiController extends Controller
{
    public function evaluator()
    {
        return view('evaluator.page');
    }
}
