<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repository\admin\CriteriaRepository;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    protected $criteriaRepo;

    public function __construct()
    {
        $this->criteriaRepo = new CriteriaRepository();
    }

    public function show()
    {
        return view('components.admin.form-criteria');
    }

    public function getlist(Request $request)
    {
        $param = json_decode($request->input('data'));
        $filter = "%";
        if ($param->filter != '') {
            $filter = $param->filter;
        }
        $data = $this->criteriaRepo->getlistCriteria($filter);
        return $data;
    }

    public function add(Request $request)
    {
        $param = json_decode($request->input('data'));
        $result = $this->criteriaRepo->addCriteria($param);
        return $result;
    }

    public function update(Request $request)
    {
        $param = json_decode($request->input('data'));
        $result = $this->criteriaRepo->updateCriteria($param);
        return $result;
    }

    public function delete(Request $request)
    {
        $param = json_decode($request->input('data'));
        $result = $this->criteriaRepo->deleteCriteria($param);
        return $result;
    }
    
}
