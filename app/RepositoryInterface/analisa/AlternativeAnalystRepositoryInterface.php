<?php

namespace App\RepositoryInterface\analisa;


interface AlternativeAnalystRepositoryInterface
{
    public function getlistAlternative();
    public function delAlternativeAnalyst($criteria);
    public function addAlternativeAnalyst($data, $criteria);
    public function updateAlternativeAnalyst($key, $data, $bobot, $criteria);
    public function addAlternativeAnalystResult($data, $criteria);
}
