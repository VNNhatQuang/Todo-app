<?php

namespace App\Services;

use App\Repositories\NavigationRepository;

class NavigationService {

    protected $navigationRepository;

    public function __construct(NavigationRepository $navigationRepository) {
        $this->navigationRepository = $navigationRepository;
    }


    public function countNoteByID($user_name)
    {
        return $this->navigationRepository->countNoteByID($user_name);
    }



}
