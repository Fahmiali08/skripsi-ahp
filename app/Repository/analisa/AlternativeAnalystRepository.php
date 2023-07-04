<?php

namespace App\Repository\analisa;

use App\RepositoryInterface\analisa\AlternativeAnalystRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AlternativeAnalystRepository implements AlternativeAnalystRepositoryInterface
{
    public function getlistAlternative()
    {
        $result = DB::table('mst_alternative')->select('alternative_id', 'alternative_name')
            ->orderBy('alternative_id', 'asc')
            ->get();
        return $result;
    }
    public function delAlternativeAnalyst($criteria){
        $result = '';
        // Begin Transaction
        DB::beginTransaction();
        try {

            DB::table('trx_alternative_analyst')->where('criteria_id', $criteria)->delete();

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
    public function addAlternativeAnalyst($data, $criteria){
        $result = '';
        // Begin Transaction
        DB::beginTransaction();
        try {

            DB::table('trx_alternative_analyst')->insert([
                'alternative_analyst_id' => $data['key'],
                'alternative_analyst_value' => json_encode($data['horizontal_value']),
                'alternative_analyst_vertical_value' => json_encode($data['vertical_value']),
                'eigen_vertical_value' => json_encode($data['eigen_vertical']),
                'total_value' => $data['total'],
                'total_eigen' => $data['total_eigen'],
                'criteria_id' => $criteria
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
    public function updateAlternativeAnalyst($key, $data, $bobot, $criteria){
        $result = '';
        // Begin Transaction
        DB::beginTransaction();
        try {

            DB::table('trx_alternative_analyst')
                ->where('alternative_analyst_id', $key)
                ->where('criteria_id', $criteria)->update([
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
    public function addAlternativeAnalystResult($data, $criteria){
        $result = '';
        // Begin Transaction
        DB::beginTransaction();
        try {

            DB::table('trx_alternative_analyst_result')->where('criteria_id', $criteria)->delete();
            DB::table('trx_alternative_analyst_result')->insert([
                'consistency_index' => $data['ci'],
                'ratio_index' => $data['ri'],
                'consistency_ratio' => $data['cr'],
                'consistency' => $data['consistency'],
                'criteria_id' => $criteria
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
