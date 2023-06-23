<?php

namespace App\Repositories;

use App\Models\Note;

class NoteRepository
{

    /**
     * Lấy danh sách tất cả các Note chưa hoàn thành theo user_name - Phân trang
     *
     * @param [string] $user_name
     * @param [string] $searchValue
     * @param [int] $pageSize
     * @return array
     */
    public function getList($user_name, $searchValue, $pageSize)
    {
        return Note::where('user_name', $user_name)
            ->where('is_complete', 0)
            ->where('is_delete', 0)
            ->where("content", "LIKE", "%$searchValue%")
            ->paginate($pageSize);
    }


    /**
     * Lấy danh sách tất cả các Note quan trọng theo user_name - Phân trang
     *
     * @param [string] $user_name
     * @param [string] $searchValue
     * @param [int] $pageSize
     * @return array
     */
    public function getListImportant($user_name, $searchValue, $pageSize)
    {
        return Note::where('user_name', $user_name)
            ->where("important", 1)
            ->where('is_complete', 0)
            ->where('is_delete', 0)
            ->where("content", "LIKE", "%$searchValue%")
            ->orderBy('created_at', 'asc')
            ->paginate($pageSize);
    }


    /**
     * Lấy danh sách tất cả các Note đã hoàn thành theo user_name - Phân trang
     *
     * @param [string] $user_name
     * @param [string] $searchValue
     * @param [int] $pageSize
     * @return array
     */
    public function getListComplete($user_name, $searchValue, $pageSize)
    {
        return Note::where('user_name', $user_name)
            ->where('is_complete', 1)
            ->where('is_delete', 0)
            ->where("content", "LIKE", "%$searchValue%")
            ->orderBy('created_at', 'asc')
            ->paginate($pageSize);
    }


    /**
     * Tạo mới Note
     *
     * @param [string] $user_name
     * @param [string] $content
     * @return void
     */
    public function create($user_name, $content)
    {
        $note = new Note();
        $note->content = $content;
        $note->is_delete = 0;
        $note->important = 0;
        $note->is_complete = 0;
        $note->user_name = $user_name;
        $note->save();
    }


    /**
     * Tạo mới Note quan trọng
     *
     * @param [string] $user_name
     * @param [string] $content
     * @return void
     */
    public function createImportant($user_name, $content)
    {
        $note = new Note();
        $note->content = $content;
        $note->is_delete = 0;
        $note->important = 1;
        $note->is_complete = 0;
        $note->user_name = $user_name;
        $note->save();
    }


    /**
     * Chỉnh sửa nội dung Note
     *
     * @param [int] $id
     * @param [string] $content
     * @return void
     */
    public function editContent($id, $content)
    {
        return Note::where('id', $id)->update(['content' => $content]);
    }


    /**
     * Xóa mềm Note
     *
     * @param [int] $id
     * @return void
     */
    public function delete($id)
    {
        return Note::where('id', $id)->update(['is_delete' => 1]);
    }


    /**
     * Xóa cứng Note
     *
     * @param [int] $id
     * @return void
     */
    public function destroy($id)
    {
        Note::destroy($id);
    }


    /**
     * Đánh dấu đã hoàn thành Note
     *
     * @param [int] $id
     * @return void
     */
    public function markComplete($id)
    {
        return Note::where('id', $id)->update(['is_complete' => 1]);
    }


    /**
     * Đánh dấu quan trọng Note
     *
     * @param [int] $id
     * @return void
     */
    public function markImportant($id)
    {
        return Note::where('id', $id)->update(['important' => 1]);
    }


    /**
     * Hủy đánh dấu quan trọng Note
     *
     * @param [int] $id
     * @return void
     */
    public function unMarkImportant($id)
    {
        return Note::where('id', $id)->update(['important' => 0]);
    }
}
