<?php

namespace App\Repository\laporan;

use App\RepositoryInterface\laporan\AlternativeAnalystResultRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AlternativeAnalystResultRepository implements AlternativeAnalystResultRepositoryInterface{

    public function getlistAlternativeResult($criteria){
        $sql = "";
        $sql .= "SELECT mc.alternative_name, ca.alternative_analyst_id, ca.alternative_analyst_value, ca.total_value, ca.eigen_vertical_value, ca.eigen_horizontal_value, ca.average \n";
        $sql .= "FROM trx_alternative_analyst ca \n";
        $sql .= "LEFT JOIN mst_alternative mc ON mc.alternative_id = ca.alternative_analyst_id \n";
        $sql .= "WHERE mc.stat_active = 1 \n";
        $sql .= "and ca.criteria_id = '". $criteria."' \n";
        $sql .= "order by ca.alternative_analyst_id asc \n";
        $result = DB::select($sql);

        return $result;
    }
    public function getAlternativeResultConsistency($criteria){
        $result = DB::table('trx_alternative_analyst_result')->select('consistency_index', 'ratio_index', 'consistency_ratio', 'consistency')
                ->where('criteria_id', $criteria)
                ->get();
        return $result;
    }
}
