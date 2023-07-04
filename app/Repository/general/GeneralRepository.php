<?php

namespace App\Repository\general;

use Illuminate\Support\Facades\DB;
use App\RepositoryInterface\general\GeneralRepositoryInterface;

class GeneralRepository implements GeneralRepositoryInterface
{

    public function getlistGender()
    {
        $result = DB::table('mst_gender')->select('gender_id', 'gender_name')
            ->get();

        return $result;
    }
    public function getGender($gender)
    {
        $result = DB::table('mst_gender')->select('gender_id', 'gender_name')
            ->where('gender_name', $gender)
            ->get();
        return $result;
    }
    public function getlistReligion()
    {
        $result = DB::table('mst_religion')->select('religion_id', 'religion_name')
            ->get();

        return $result;
    }
    public function getReligion($religion)
    {
        $result = DB::table('mst_religion')->select('religion_id', 'religion_name')
            ->where('religion_name', $religion)
            ->get();
        return $result;
    }
    public function getlistGrade()
    {
        $result = DB::table('mst_grade_type')->select('grade_type_id', 'grade_type_name')
            ->get();
        return $result;
    }
    public function getGrade($grade)
    {
        $result = DB::table('mst_grade_type')->select('grade_type_id', 'grade_type_name')
            ->where('grade_type_name', $grade)
            ->get();
        return $result;
    }
}
