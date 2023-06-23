<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService {

    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }


    public function create($data)
    {
        return $this->userRepository->create($data);
    }

    public function getUserByID($user_name)
    {
        return $this->userRepository->getUserByID($user_name);
    }

    public function update($user_name, $data){
        return $this->userRepository->update($user_name, $data);
    }

}
