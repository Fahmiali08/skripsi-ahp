<?php

namespace App\Repository\admin;

use App\RepositoryInterface\admin\AlternativeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AlternativeRepository implements AlternativeRepositoryInterface
{
    public function getlistAlternative($filter)
    {
        $result = DB::table('mst_alternative')->select('alternative_id', 'alternative_name')
                    ->where('stat_active', 1)
                    ->get();
        return $result;
    }

    public function addAlternative($data){
        $result = '';
        // Begin Transaction
        DB::beginTransaction();
        try {

            $code = DB::select("SELECT CONCAT('A',LPAD(IFNULL(MAX(SUBSTRING(alternative_id,4,4)),0)+1,4,'0')) AS alternative_id FROM mst_alternative");
            DB::table('mst_alternative')->insert([
                'alternative_id' => $code[0]->alternative_id,
                'alternative_name' => $data->alternative_name
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

    public function updateAlternative($data)
    {
        $result = '';
        // Begin Transaction
        DB::beginTransaction();
        try {

            DB::table('mst_alternative')->where('alternative_id', $data->alternative_id)->update([
                'alternative_name' => $data->alternative_name
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

    public function deleteAlternative($data)
    {
        $result = '';
        // Begin Transaction
        DB::beginTransaction();
        try {

            // DB::table('mst_alternative')->where('alternative_id', $data->alternative_id)->update([
            //     'stat_active' => 0
            // ]);
            DB::table('mst_alternative')->where('alternative_id', $data->alternative_id)->delete();
            DB::table('trx_alternative_analyst')->delete();
            DB::table('trx_alternative_analyst_result')->delete();


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
