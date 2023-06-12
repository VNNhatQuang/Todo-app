<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ImportantController extends Controller
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
        $listNote = Note::where("content", "LIKE", "%$searchValue%")
            ->where("important", 1)
            ->paginate(ImportantController::PAGE_SIZE);
        $totalAll = Note::count();
        $totalImportant = Note::where("important", 1)->count();
        $totalComplete = Note::where("is_complete", 1)->count();
        return view('important.index', compact('listNote', 'searchValue', 'totalAll', 'totalImportant', 'totalComplete'));
    }
}
