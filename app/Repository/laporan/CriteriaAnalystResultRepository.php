<?php

namespace App\Repository\laporan;

use App\RepositoryInterface\laporan\CriteriaAnalystResultRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CriteriaAnalystResultRepository implements CriteriaAnalystResultRepositoryInterface{

    public function getlistCriteriaResult(){
        // $sql = "";
        // $sql .= "select CONCAT('K',LPAD(IFNULL(MAX(SUBSTRING(criteria_id,4,4)),0)+1,4,'0')) AS criteria_id \n";
        // $sql .= "from mst_criteria \n";
        // $code = DB::select($sql);
        $sql = "";
        $sql .= "SELECT mc.criteria_name, ca.criteria_analyst_id, ca.criteria_analyst_value, ca.total_value, ca.eigen_vertical_value, ca.eigen_horizontal_value, ca.average \n";
        $sql .= "FROM trx_criteria_analyst ca \n";
        $sql .= "LEFT JOIN mst_criteria mc ON mc.criteria_id = ca.criteria_analyst_id \n";
        $sql .= "WHERE mc.stat_active = 1 \n";
        $sql .= "order by ca.criteria_analyst_id asc \n";
        $result = DB::select($sql);

        return $result;
    }
    public function getCriteriaResultConsistency(){
        $result = DB::table('trx_criteria_analyst_result')->select('consistency_index', 'ratio_index', 'consistency_ratio', 'consistency')
                ->get();
        return $result;
    }
}
