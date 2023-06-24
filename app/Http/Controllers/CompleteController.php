<?php

namespace App\Http\Controllers;

use App\Services\NavigationService;
use App\Services\NoteService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompleteController extends Controller
{
    const PAGE_SIZE = 4;

    protected $navigationService;
    protected $noteService;

    public function __construct(NavigationService $navigationService, NoteService $noteService)
    {
        $this->middleware('auth');
        $this->navigationService = $navigationService;
        $this->noteService = $noteService;
    }



    /**
     * Hiển thị danh sách tất cả ghi chú
     * Tìm kiếm và phân trang
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $user = $request->session()->get('user');
        // Content
        $searchValue = $request->input('searchValue') ?? '';
        $listNote = $this->noteService->getListComplete($user->user_name, $searchValue, CompleteController::PAGE_SIZE);
        // Navigation
        $nav = $this->navigationService->countNoteByID($user->user_name);
        return view('complete.index', compact('listNote', 'searchValue', 'nav'));
    }


    /**
     * Xóa note đã hoàn thành - Xóa cứng
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $this->noteService->destroy($id);
        return back();
    }
}
