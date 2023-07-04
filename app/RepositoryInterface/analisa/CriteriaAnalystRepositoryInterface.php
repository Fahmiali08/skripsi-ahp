<?php

namespace App\RepositoryInterface\analisa;


interface CriteriaAnalystRepositoryInterface
{
    public function getlistCriteria();
    public function delCriteriaAnalyst();
    public function addCriteriaAnalyst($data);
    public function updateCriteriaAnalyst($key, $data, $bobot);
    public function addCriteriaAnalystResult($data);
}
