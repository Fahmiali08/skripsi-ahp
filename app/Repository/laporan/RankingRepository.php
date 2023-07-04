<?php

namespace App\Repository\laporan;

use App\RepositoryInterface\laporan\RankingRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RankingRepository implements RankingRepositoryInterface{

    public function getlist(){
        $sql = "";
        $sql .= "select ma.alternative_id, ma.alternative_name, vTrx.hasil \n";
        $sql .= "from mst_alternative ma \n";
        $sql .= "left join( \n";
        $sql .= "	SELECT vData.alternative_analyst_id, SUM(vData.hasil) AS hasil \n";
        $sql .= "	FROM( \n";
        $sql .= "		SELECT taa.alternative_analyst_id, taa.average AS average_alternative, tca.average AS average_criteria, \n";
        $sql .= "			(taa.average*tca.average) AS hasil \n";
        $sql .= "		FROM trx_alternative_analyst taa \n";
        $sql .= "		LEFT JOIN trx_criteria_analyst tca ON tca.criteria_analyst_id = taa.criteria_id \n";
        $sql .= "	)vData \n";
        $sql .= "	GROUP BY vData.alternative_analyst_id \n";
        $sql .= ")vTrx on ma.alternative_id = vTrx.alternative_analyst_id \n";
        $sql .= "order by vTrx.hasil desc \n";

        $result = DB::select($sql);

        return $result;
    }
}
