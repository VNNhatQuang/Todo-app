<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{


    /**
     * Tạo mới User
     *
     * @param [array] $data
     * @return void
     */
    public function create($data)
    {
        return User::create($data);
    }


    /**
     * Lấy thông tin của User dựa vào user_name
     *
     * @param [User] $user_name
     * @return User
     */
    public function getUserByID($user_name)
    {
        return User::where('user_name', $user_name)->first();
    }


    /**
     * Cập nhật thông tin User dựa vào user_name
     *
     * @param [string] $user_name
     * @param [array] $data
     * @return void
     */
    public function update($user_name, $data)
    {
        return User::where('user_name', $user_name)
            ->update($data);
    }
}
