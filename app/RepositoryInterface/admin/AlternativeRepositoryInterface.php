<?php

namespace App\RepositoryInterface\admin;


interface AlternativeRepositoryInterface
{
    public function getlistAlternative($filter);
    public function addAlternative($data);
    public function updateAlternative($data);
    public function deleteAlternative($data);
}
