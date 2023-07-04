<?php

namespace App\Service;

use App\Repository\UserRepository;
use Exception;


class UserService {

    protected $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        //Do your magic here
        $this->userRepository = $userRepository;
    }

}
