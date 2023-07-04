<?php

namespace App\RepositoryInterface\general;

interface GeneralRepositoryInterface
{

    public function getlistGender();
    public function getGender($gender);

    public function getlistReligion();
    public function getReligion($religion);

    public function getlistGrade();
    public function getGrade($grade);
}
