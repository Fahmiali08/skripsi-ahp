<?php

namespace App\Http\Controllers\analisa;

error_reporting(~E_NOTICE);

use App\Helpers\AHP;
use App\Http\Controllers\Controller;
use App\Repository\analisa\AlternativeAnalystRepository;
use App\Repository\analisa\CriteriaAnalystRepository;
use Illuminate\Http\Request;

class AlternativeAnalystController extends Controller
{
    protected $alternativeAnalystRepo;
    protected $criteriaAnalystRepo;

    protected $ahp;

    public function __construct()
    {
        $this->alternativeAnalystRepo = new AlternativeAnalystRepository();
        $this->criteriaAnalystRepo = new CriteriaAnalystRepository();
        $this->ahp = new AHP();
    }

    public function show()
    {
        $alternative= $this->alternativeAnalystRepo->getlistAlternative();
        $criteria = $this->criteriaAnalystRepo->getlistCriteria();
        $data = [
            'alternatives' => $alternative,
            'criterias' => $criteria
        ];
        return view('components.analisa.form-alternative-analyst')->with($data);
    }

    public function getlist(Request $request)
    {
        $data = $this->alternativeAnalystRepo->getlistAlternative();
        return $data;
    }

    public function add(Request $request)
    {
        // $param = json_decode($request->input('data'));
        $param = json_decode($request->input('data'), true);
        $result = "";
        $criteria = $param['criteria'];
        $delAnalyst = $this->alternativeAnalystRepo->delAlternativeAnalyst($criteria);
        if($delAnalyst == 1){
            $arr_matrix = array();
            $arr_key = array();

            foreach ($param['analyst'] as $i => $header) {
                //     // error_log(json_encode($header['horizontal_value']));
                $detail = array();
                foreach ($header['horizontal_value'] as $j => $jheader) {
                    // array_push($detail, $jheader['data_value']);
                    $detail[$j] = $jheader['data_value'];
                }
                $arr_matrix[] = $detail;
                $arr_key[] = $header['key'];
                $result = $this->alternativeAnalystRepo->addAlternativeAnalyst($header, $criteria);
                // print_r($row_total);
            }
            $row_total = $this->ahp->get_row_total($arr_matrix);
            $normal = $this->ahp->normalize($arr_matrix, $row_total);
            $priority = $this->ahp->get_priority($normal);
            $arr_normal = array();

            foreach ($priority as $p => $bobot) {
                foreach ($normal as $k => $a) {
                    if($p == $k){
                        foreach ($arr_key as $i => $n) {
                            if($k == $i){
                                $data[] = array(
                                    'key' => $n,
                                    'data' => $a,
                                    'average' => $bobot
                                );
                                $arr_normal = json_encode($data);
                                $result = $this->alternativeAnalystRepo->updateAlternativeAnalyst($n,$a,$bobot, $criteria);
                            }
                        }
                    }
                }
            }
            $cm = $this->ahp->get_cm($arr_matrix, $priority);
            $consistency = $this->ahp->get_consistency($cm);
            // echo 'CI: ' . $consistency['ci'] . '<br />';
            // echo 'CI: ' . $consistency['ri'] . '<br />';
            // echo 'CR: ' . $consistency['cr'] . '<br />';
            // echo 'Consistency: ' . $consistency['consistency'] . '<br />';
            $result = $this->alternativeAnalystRepo->addAlternativeAnalystResult($consistency, $criteria);
        }

        return $result;
    }

    public function doNormalize()
    {
        // $param = json_decode($request->input('data'));
        $data = $this->alternativeAnalystRepo->getlistAlternative();
        $result = "";
        $matrix = array(
            array(1, 2, 3),
            array(1 / 2, 1, 3),
            array(1 / 3, 1 / 3, 1),
        );
        $row_total = $this->get_row_total($matrix);
        print_r($row_total);
        $normal = $this->normalize($matrix, $row_total);
        print_r($normal);

        $priority = $this->get_priority($normal);
        print_r($priority);
        return $result;
    }
}
