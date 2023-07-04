<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repository\admin\AlternativeRepository;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    protected $alternativeRepo;

    public function __construct()
    {
        $this->alternativeRepo = new AlternativeRepository();
    }

    public function show()
    {
        return view('components.admin.form-alternative');
    }

    public function getlist(Request $request)
    {
        $param = json_decode($request->input('data'));
        $filter = "%";
        if ($param->filter != '') {
            $filter = $param->filter;
        }
        $data = $this->alternativeRepo->getlistAlternative($filter);
        return $data;
    }

    public function add(Request $request)
    {
        $param = json_decode($request->input('data'));
        $result = $this->alternativeRepo->addAlternative($param);
        return $result;
    }

    public function update(Request $request)
    {
        $param = json_decode($request->input('data'));
        $result = $this->alternativeRepo->updateAlternative($param);
        return $result;
    }

    public function delete(Request $request)
    {
        $param = json_decode($request->input('data'));
        $result = $this->alternativeRepo->deleteAlternative($param);
        return $result;
    }
}
