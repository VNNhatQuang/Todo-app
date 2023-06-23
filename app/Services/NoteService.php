<?php

namespace App\Services;

use App\Repositories\NoteRepository;

class NoteService
{

    protected $noteRepository;

    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }



    public function getList($user_name, $searchValue, $pageSize)
    {
        return $this->noteRepository->getList($user_name, $searchValue, $pageSize);
    }


    public function getListImportant($user_name, $searchValue, $pageSize)
    {
        return $this->noteRepository->getListImportant($user_name, $searchValue, $pageSize);
    }


    public function getListComplete($user_name, $searchValue, $pageSize)
    {
        return $this->noteRepository->getListComplete($user_name, $searchValue, $pageSize);
    }


    public function create($user_name, $content)
    {
        $this->noteRepository->create($user_name, $content);
    }


    public function createImportant($user_name, $content)
    {
        $this->noteRepository->createImportant($user_name, $content);
    }


    public function editContent($id, $content)
    {
        return $this->noteRepository->editContent($id, $content);
    }


    public function delete($id)
    {
        return $this->noteRepository->delete($id);
    }


    public function destroy($id)
    {
        $this->noteRepository->destroy($id);
    }


    public function markComplete($id)
    {
        return $this->noteRepository->markComplete($id);
    }


    public function markImportant($id)
    {
        return $this->noteRepository->markImportant($id);
    }


    public function unMarkImportant($id)
    {
        return $this->noteRepository->unMarkImportant($id);
    }
}
