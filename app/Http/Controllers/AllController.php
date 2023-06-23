<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Rules\SpacingRule;
use App\Services\NavigationService;
use App\Services\NoteService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AllController extends Controller
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
     * @return void
     */
    public function index(Request $request): View
    {
        $user = $request->session()->get('user');
        // Content
        $searchValue = $request->input('searchValue') ?? '';
        $listNote = $this->noteService->getList($user->user_name, $searchValue, AllController::PAGE_SIZE);
        // Navigation
        $nav = $this->navigationService->countNoteByID($user->user_name);
        return view('all.index', compact('listNote', 'searchValue', 'nav'));
    }


    /**
     * Tạo mới ghi chú
     *
     * @param Request $request
     */
    public function create(NoteRequest $request)
    {
        $user = $request->session()->get('user');
        $data = $request->validated();
        $this->noteService->create($user->user_name, $data['content']);
        return back();
    }


    /**
     * Sửa ghi chú
     *
     * @param Request $request
     * @param [int] $id
     */
    public function edit(NoteRequest $request, $id)
    {
        $data = $request->validated();
        $this->noteService->editContent($id, $data['content']);
        return back();
    }


    /**
     * Xóa ghi chú - Xóa mềm
     *
     * @param [int] $id
     */
    public function delete($id)
    {
        $this->noteService->delete($id);
        return back();
    }


    /**
     * Đánh dấu ghi chú là đã hoàn thành
     *
     * @param Request $request
     */
    public function markComplete(Request $request)
    {
        $data = $request->all();
        foreach ($data as $id => $value) {
            $this->noteService->markComplete($id);
            break;
        }
        return back();
    }


    /**
     * Đánh dấu ghi chú là quan trọng
     *
     * @param [int] $id
     */
    public function markImportant($id)
    {
        $this->noteService->markImportant($id);
        return back();
    }


    /**
     * Hủy đánh dấu quan trọng
     *
     * @param [int] $id
     */
    public function unMarkImportant($id)
    {
        $this->noteService->unMarkImportant($id);
        return back();
    }
}
