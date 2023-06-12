<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AllController extends Controller
{
    const PAGE_SIZE = 5;

    /**
     * Hiển thị danh sách tất cả ghi chú
     * Tìm kiếm và phân trang
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request): View
    {
        $searchValue = $request->input('searchValue') ?? '';
        $listNote = Note::where("content", "LIKE", "%$searchValue%")->paginate(AllController::PAGE_SIZE);
        $totalAll = Note::count();
        $totalImportant = Note::where("important", 1)->count();
        $totalComplete = Note::where("is_complete", 1)->count();
        return view('all.index', compact('listNote', 'searchValue', 'totalAll', 'totalImportant', 'totalComplete'));
    }

    /**
     * Tạo mới ghi chú
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        echo 'create';
    }

    /**
     * Sửa ghi chú
     *
     * @param Request $request
     * @return void
     */
    public function edit(Request $request)
    {
    }

    /**
     * Xóa ghi chú
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request)
    {
    }

    /**
     * Đánh dấu ghi chú là quan trọng
     *
     * @param Request $request
     * @return void
     */
    public function markImportant(Request $request)
    {
    }
}
