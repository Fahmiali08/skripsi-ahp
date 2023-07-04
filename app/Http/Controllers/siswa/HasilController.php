<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HasilController extends Controller
{

    public function show()
    {
        return view('components..siswa.hasil');
    }

}
