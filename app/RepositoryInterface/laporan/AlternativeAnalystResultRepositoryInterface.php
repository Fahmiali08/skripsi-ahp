<?php

namespace App\RepositoryInterface\laporan;

interface AlternativeAnalystResultRepositoryInterface{
    public function getlistAlternativeResult($criteria);
    public function getAlternativeResultConsistency($criteria);
}
