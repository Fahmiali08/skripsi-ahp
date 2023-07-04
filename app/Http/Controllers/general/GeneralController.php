<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\general\GeneralRepository;

class GeneralController extends Controller
{
    protected $generalRepo;

    public function __construct()
    {
        $this->generalRepo = new GeneralRepository();
    }

    public function getlistGender()
    {
        $data = $this->generalRepo->getlistGender();
        return $data;
    }

    public function getGender(Request $request)
    {
        $param = json_decode($request->input('data'));
        $data = $this->generalRepo->getGender($param->gender);
        return $data;
    }

    public function getlistReligion()
    {
        $data = $this->generalRepo->getlistReligion();
        return $data;
    }

    public function getReligion(Request $request)
    {
        $param = json_decode($request->input('data'));
        $data = $this->generalRepo->getReligion($param->religion);
        return $data;
    }

    public function getlistGrade()
    {
        $data = $this->generalRepo->getlistGrade();
        return $data;
    }

    public function getGrade(Request $request)
    {
        $param = json_decode($request->input('data'));
        $data = $this->generalRepo->getGrade($param->grade);
        return $data;
    }
}
