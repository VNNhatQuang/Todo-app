<?php

namespace App\Repositories;

use App\Models\Note;
use App\Models\User;

class NavigationRepository
{

    /**
     * Đếm số ghi chú trên mỗi loại dựa vào user_name
     *
     * @param [string] $user_name
     * @return array
     */
    public function countNoteByID($user_name)
    {
        return [
            'totalAll' => Note::where(['user_name' => $user_name, 'is_complete' => 0, 'is_delete' => 0])->count(),
            'totalImportant' => Note::where(['user_name' => $user_name, 'is_complete' => 0, "important" => 1, "is_delete" => 0])->count(),
            'totalComplete' => Note::where(['user_name' => $user_name, "is_complete" => 1, "is_delete" => 0])->count(),
        ];
    }
}
