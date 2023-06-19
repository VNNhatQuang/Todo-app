<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CompleteController extends Controller
{
    const PAGE_SIZE = 4;



    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Hiển thị danh sách tất cả ghi chú
     * Tìm kiếm và phân trang
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request) : View
    {
        $user = $request->session()->get('user');

        // Content
        $searchValue = $request->input('searchValue') ?? '';
        $listNote = Note::where('user_name', $user->user_name)
            ->where("content", "LIKE", "%$searchValue%")
            ->where("is_complete", 1)
            ->orderBy('updated_at', 'asc')
            ->paginate(CompleteController::PAGE_SIZE);
        // Navigation
        $totalAll = Note::where(['user_name' => $user->user_name, 'is_complete' => 0, 'is_delete' => 0])->count();
        $totalImportant = Note::where(['user_name' => $user->user_name, 'is_complete' => 0, "important" => 1, "is_delete" => 0])->count();
        $totalComplete = Note::where(['user_name' => $user->user_name, "is_complete" => 1, "is_delete" => 0])->count();
        return view('complete.index', compact('listNote', 'searchValue', 'totalAll', 'totalImportant', 'totalComplete'));
    }


    /**
     * Xóa note đã hoàn thành - Xóa cứng
     *
     * @param [int] $id
     */
    public function delete($id)
    {
        Note::destroy($id);
        return back();
    }
}
