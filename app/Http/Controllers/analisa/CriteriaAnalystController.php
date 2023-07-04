<?php

namespace App\Http\Controllers\analisa;
error_reporting(~E_NOTICE);
use App\Http\Controllers\Controller;
use App\Repository\analisa\CriteriaAnalystRepository;
use Illuminate\Http\Request;

class CriteriaAnalystController extends Controller
{
    protected $criteriaAnalystRepo;

    public function __construct()
    {
        $this->criteriaAnalystRepo = new CriteriaAnalystRepository();
    }

    public function show()
    {
        $criteria= $this->criteriaAnalystRepo->getlistCriteria();
        $data = [
            'criterias' => $criteria
        ];
        return view('components.analisa.form-criteria-analyst')->with($data);
    }

    public function getlist(Request $request)
    {
        $data = $this->criteriaAnalystRepo->getlistCriteria();
        return $data;
    }

    public function add(Request $request)
    {
        // $param = json_decode($request->input('data'));
        $param = json_decode($request->input('data'), true);
        $result = "";

        $delAnalyst = $this->criteriaAnalystRepo->delCriteriaAnalyst();
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
                $result = $this->criteriaAnalystRepo->addCriteriaAnalyst($header);
                // print_r($row_total);
            }
            $row_total = $this->get_row_total($arr_matrix);
            $normal = $this->normalize($arr_matrix, $row_total);
            $priority = $this->get_priority($normal);
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
                                $result = $this->criteriaAnalystRepo->updateCriteriaAnalyst($n,$a,$bobot);
                            }
                        }
                    }
                }
            }
            $cm = $this->get_cm($arr_matrix, $priority);
            $consistency = $this->get_consistency($cm);
            // echo 'CI: ' . $consistency['ci'] . '<br />';
            // echo 'CI: ' . $consistency['ri'] . '<br />';
            // echo 'CR: ' . $consistency['cr'] . '<br />';
            // echo 'Consistency: ' . $consistency['consistency'] . '<br />';
            $result = $this->criteriaAnalystRepo->addCriteriaAnalystResult($consistency);
            // print_r($arr_normal);

            // $arr_priority = array();
            // foreach ($priority as $p => $bobot) {
            //     $prio[] = array(
            //         'average' => $bobot
            //     );
            //     $arr_priority = json_encode($prio);
            // }

            // print_r($arr_priority);
        }

        // $matrix = array(
        //     array(1, 2, 3),
        //     array(1 / 2, 1, 3),
        //     array(1 / 3, 1 / 3, 1),
        // );
        // error_log(get_row_total($matrix));
        return $result;
    }

    public function doNormalize()
    {
        // $param = json_decode($request->input('data'));
        $data = $this->criteriaAnalystRepo->getlistCriteria();
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

    function get_row_total($matrix)
    {
        $arr = array();
        foreach ($matrix as $key => $val) {
            foreach ($val as $k => $v) {
                $arr[$k] += $v;
            }
        }
        return $arr;
    }

    function normalize($matrix, $row_total)
    {
        $arr = array();
        foreach ($matrix as $key => $val) {
            foreach ($val as $k => $v) {
                $arr[$key][$k] = $v / $row_total[$k];
            }
        }
        return $arr;
    }

    function get_priority($normal)
    {
        $arr = array();
        foreach ($normal as $key => $val) {
            $arr[$key] = array_sum($val) / count($val);
        }
        return $arr;
    }

    function get_cm($matrix, $priority)
    {
        $arr = array();
        foreach ($matrix as $key => $val) {
            foreach ($val as $k => $v) {
                $arr[$key] += $v * $priority[$k];
            }
        }

        foreach ($arr as $key => $val) {
            $arr[$key] = $val / $priority[$key];
        }

        return $arr;
    }

    function get_consistency($cm)
    {
        $arr = array();

        $sum = array_sum($cm);
        $count = count($cm);
        $arr['ci'] = (($sum / $count) - $count) / ($count - 1);

        $nRI = array(
            1 => 0,
            2 => 0,
            3 => 0.58,
            4 => 0.9,
            5 => 1.12,
            6 => 1.24,
            7 => 1.32,
            8 => 1.41,
            9 => 1.46,
            10 => 1.49,
            11 => 1.51,
            12 => 1.48,
            13 => 1.56,
            14 => 1.57,
            15 => 1.59
        );
        $arr['ri'] = $nRI[count($cm)];
        $arr['cr'] = $arr['ci'] / $arr['ri'];
        $arr['consistency'] =  $arr['cr'] <= 0.1 ? 'consistent' : 'inconsistent';

        return $arr;
    }
    function display($arr, $echo = true)
    {
        $result = '<table border="1">';
        foreach ($arr as $key => $val) {
            $result .= '<tr>';
            foreach ($val as $k => $v) {
                $result .= '<td>' . $v . '</td>';
            }
            $result .= '</tr>';
        }
        $result .= '</table>';

        if ($echo)
            echo $result;
        else
            return $result;
    }
}
