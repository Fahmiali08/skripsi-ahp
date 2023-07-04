<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use App\Repository\laporan\RankingRepository;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    protected $rankingRepo;
    public function __construct()
    {
        $this->rankingRepo = new RankingRepository();
    }

    public function show()
    {
        $ranking = $this->rankingRepo->getlist();
        $data = [
            'rankings' => $ranking
        ];
        return view('components.laporan.form-ranking')->with($data);
    }
}
