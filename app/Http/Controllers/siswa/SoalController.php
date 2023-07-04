<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SoalController extends Controller
{

    public function show()
    {
        return view('components..siswa.soal');
    }

}
