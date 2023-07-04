<?php

namespace App\RepositoryInterface\admin;


interface CriteriaRepositoryInterface
{
    public function getlistCriteria($filter);
    public function addCriteria($data);
    public function updateCriteria($data);
    public function deleteCriteria($data);
}
