<?php

namespace App\Http\Controllers\laporan;

error_reporting(~E_NOTICE);

use App\Helpers\AHP;
use App\Http\Controllers\Controller;
use App\Repository\laporan\AlternativeAnalystResultRepository;
use App\Repository\analisa\CriteriaAnalystRepository;
use Illuminate\Http\Request;

class AlternativeAnalystResultController extends Controller
{
    protected $alternativeAnalystResultRepo;
    protected $criteriaAnalystRepo;

    public function __construct()
    {
        $this->alternativeAnalystResultRepo = new AlternativeAnalystResultRepository();
        $this->criteriaAnalystRepo = new CriteriaAnalystRepository();
    }

    public function show()
    {
        $alternative = $this->alternativeAnalystResultRepo->getlistAlternativeResult('C0001');
        $consistency = $this->alternativeAnalystResultRepo->getAlternativeResultConsistency('C0001');
        $criteria = $this->criteriaAnalystRepo->getlistCriteria();
        $data = [
            'alternatives' => $alternative,
            'consistency' =>  $consistency[0],
            'criterias' => $criteria
        ];

        return view('components.laporan.form-alternative-analyst-result')->with($data);
    }

    public function getlist(Request $request)
    {

        $param = json_decode($request->input('data'), true);
        $criteria = $param['criteria'];

        $alternative = $this->alternativeAnalystResultRepo->getlistAlternativeResult($criteria);
        $consistency = $this->alternativeAnalystResultRepo->getAlternativeResultConsistency($criteria);
        $criteria = $this->criteriaAnalystRepo->getlistCriteria();
        $data = [
            'alternatives' => $alternative,
            'consistency' =>  $consistency[0],
            'criterias' => $criteria
        ];
        return $data;
    }
}
