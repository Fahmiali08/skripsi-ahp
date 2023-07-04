<?php

namespace App\Repository\analisa;

use App\RepositoryInterface\analisa\CriteriaAnalystRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CriteriaAnalystRepository implements CriteriaAnalystRepositoryInterface
{
    public function getlistCriteria()
    {
        $result = DB::table('mst_criteria')->select('criteria_id', 'criteria_name')
            ->orderBy('criteria_id', 'asc')
            ->get();
        return $result;
    }
    public function delCriteriaAnalyst(){
        $result = '';
        // Begin Transaction
        DB::beginTransaction();
        try {

            DB::table('trx_criteria_analyst')->delete();

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
    public function addCriteriaAnalyst($data){
        $result = '';
        // Begin Transaction
        DB::beginTransaction();
        try {

            // DB::table('trx_criteria_analyst')->where('criteria_analyst_id', $data['key'])->delete();
            DB::table('trx_criteria_analyst')->insert([
                'criteria_analyst_id' => $data['key'],
                'criteria_analyst_value' => json_encode($data['horizontal_value']),
                'criteria_analyst_vertical_value' => json_encode($data['vertical_value']),
                'eigen_vertical_value' => json_encode($data['eigen_vertical']),
                'total_value' => $data['total'],
                'total_eigen' => $data['total_eigen']
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
    public function updateCriteriaAnalyst($key, $data, $bobot){
        $result = '';
        // Begin Transaction
        DB::beginTransaction();
        try {

            DB::table('trx_criteria_analyst')->where('criteria_analyst_id', $key)->update([
                'eigen_horizontal_value' => $data,
                'average' => $bobot
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
    public function addCriteriaAnalystResult($data){
        $result = '';
        // Begin Transaction
        DB::beginTransaction();
        try {

            DB::table('trx_criteria_analyst_result')->delete();
            DB::table('trx_criteria_analyst_result')->insert([
                'consistency_index' => $data['ci'],
                'ratio_index' => $data['ri'],
                'consistency_ratio' => $data['cr'],
                'consistency' => $data['consistency']
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
}
