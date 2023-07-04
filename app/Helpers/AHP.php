<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

error_reporting(~E_NOTICE);
class AHP{
    public static function get_row_total($matrix)
    {
        $arr = array();
        foreach ($matrix as $key => $val) {
            foreach ($val as $k => $v) {
                $arr[$k] += $v;
            }
        }
        return $arr;
    }

    public static function normalize($matrix, $row_total)
    {
        $arr = array();
        foreach ($matrix as $key => $val) {
            foreach ($val as $k => $v) {
                $arr[$key][$k] = $v / $row_total[$k];
            }
        }
        return $arr;
    }

    public static function get_priority($normal)
    {
        $arr = array();
        foreach ($normal as $key => $val) {
            $arr[$key] = array_sum($val) / count($val);
        }
        return $arr;
    }

    public static function get_cm($matrix, $priority)
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

    public static function get_consistency($cm)
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
}
