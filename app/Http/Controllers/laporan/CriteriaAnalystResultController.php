<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use App\Repository\laporan\CriteriaAnalystResultRepository;
use Illuminate\Http\Request;

class CriteriaAnalystResultController extends Controller
{
    protected $criteriaAnalystResultRepo;

    public function __construct()
    {
        $this->criteriaAnalystResultRepo = new CriteriaAnalystResultRepository();
    }

    public function show()
    {
        $criteria = $this->criteriaAnalystResultRepo->getlistCriteriaResult();
        $consistency = $this->criteriaAnalystResultRepo->getCriteriaResultConsistency();
        $data = [
            'criterias' => $criteria,
            'consistency' =>  $consistency[0]
        ];
        return view('components.laporan.form-criteria-analyst-result')->with($data);
    }
}

