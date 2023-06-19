<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Rules\NoteRule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AllController extends Controller
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
            ->where('is_complete', '!=', 1)
            ->where('is_delete', 0)
            ->where("content", "LIKE", "%$searchValue%")
            ->paginate(AllController::PAGE_SIZE);
        // Navigation
        $totalAll = Note::where(['user_name' => $user->user_name, 'is_complete' => 0, 'is_delete' => 0])->count();
        $totalImportant = Note::where(['user_name' => $user->user_name, 'is_complete' => 0, "important" => 1, "is_delete" => 0])->count();
        $totalComplete = Note::where(['user_name' => $user->user_name, "is_complete" => 1, "is_delete" => 0])->count();
        return view('all.index', compact('listNote', 'searchValue', 'totalAll', 'totalImportant', 'totalComplete'));
    }


    /**
     * Tạo mới ghi chú
     *
     * @param Request $request
     */
    public function create(Request $request)
    {
        $user = $request->session()->get('user');

        $data = $request->all();
        $validator = Validator::make($data, [
            'content' => [new NoteRule],
        ]);

        if ($validator->fails()) {
            // Xử lý khi dữ liệu không hợp lệ
            return back()
                ->withErrors($validator);
        } else {
            $note = new Note();
            $note->content = $data['content'];
            $note->is_delete = 0;
            $note->important = 0;
            $note->is_complete = 0;
            $note->user_name = $user->user_name;
            $note->save();
        }

        return back();
    }


    /**
     * Sửa ghi chú
     *
     * @param Request $request
     * @param [int] $id
     */
    public function edit(Request $request, $id)
    {
        // Validate
        $data = $request->all();
        $validator = Validator::make($data, [
            'contentEdit' => [new NoteRule],
        ]);

        if ($validator->fails()) {
            // Xử lý khi dữ liệu không hợp lệ
            return back()
                ->withErrors($validator);
        } else {
            // Update
            Note::where('id', $id)->update(['content' => $data['contentEdit']]);
            return back();
        }
    }


    /**
     * Xóa ghi chú - Xóa mềm
     *
     * @param [int] $id
     */
    public function delete($id)
    {
        Note::where('id', $id)->update(['is_delete' => 1]);
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
            Note::where('id', $id)->update(['is_complete' => 1]);
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
        Note::where('id', $id)->update(['important' => 1]);
        return back();
    }


    /**
     * Hủy đánh dấu quan trọng
     *
     * @param [int] $id
     */
    public function unMarkImportant($id)
    {
        Note::where('id', $id)->update(['important' => 0]);
        return back();
    }
}
