<?php

namespace App\Repository\admin;

use App\RepositoryInterface\admin\CriteriaRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CriteriaRepository implements CriteriaRepositoryInterface
{
    public function getlistCriteria($filter)
    {
        $result = DB::table('mst_criteria')->select('criteria_id', 'criteria_name')
                    ->where('stat_active', 1)
                    ->get();
        return $result;
    }

    public function addCriteria($data){
        $result = '';
        // Begin Transaction
        DB::beginTransaction();
        try {

            // $sql = "";
            // $sql .= "select CONCAT('K',LPAD(IFNULL(MAX(SUBSTRING(criteria_id,4,4)),0)+1,4,'0')) AS criteria_id \n";
            // $sql .= "from mst_criteria \n";
            // $code = DB::select($sql);

            $code = DB::select("SELECT CONCAT('C',LPAD(IFNULL(MAX(SUBSTRING(criteria_id,4,4)),0)+1,4,'0')) AS criteria_id FROM mst_criteria");
            DB::table('mst_criteria')->insert([
                'criteria_id' => $code[0]->criteria_id,
                'criteria_name' => $data->criteria_name
            ]);

            // Commit Transaction
            DB::commit();
            $result = '1';
            // Semua proses benar
        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollback();
            // ada yang error
            $result = $e->getMessage();
        }

        return $result;
    }

    public function updateCriteria($data)
    {
        $result = '';
        // Begin Transaction
        DB::beginTransaction();
        try {

            DB::table('mst_criteria')->where('criteria_id', $data->criteria_id)->update([
                'criteria_name' => $data->criteria_name
            ]);

            // Commit Transaction
            DB::commit();
            $result = '1';
            // Semua proses benar
        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollback();
            // ada yang error
            $result = $e->getMessage();
        }

        return $result;
    }

    public function deleteCriteria($data)
    {
        $result = '';
        // Begin Transaction
        DB::beginTransaction();
        try {

            // DB::table('mst_criteria')->where('criteria_id', $data->criteria_id)->update([
            //     'stat_active' => 0
            // ]);
            DB::table('mst_criteria')->where('criteria_id', $data->criteria_id)->delete();
            DB::table('trx_criteria_analyst')->delete();
            DB::table('trx_criteria_analyst_result')->delete();

            // Commit Transaction
            DB::commit();
            $result = '1';
            // Semua proses benar
        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollback();
            // ada yang error
            $result = $e->getMessage();
        }

        return $result;
    }
}
