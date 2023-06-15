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

    /**
     * Hiển thị danh sách tất cả ghi chú
     * Tìm kiếm và phân trang
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request): View
    {
        // Content
        $searchValue = $request->input('searchValue') ?? '';
        $listNote = Note::where('user_name', 'vnnquang')
            ->where('is_complete', '!=', 1)
            ->where('is_delete', 0)
            ->where("content", "LIKE", "%$searchValue%")
            ->paginate(AllController::PAGE_SIZE);
        // Navigation
        $totalAll = Note::where(['user_name' => 'vnnquang', 'is_complete' => 0, 'is_delete' => 0])->count();
        $totalImportant = Note::where(['user_name' => 'vnnquang', 'is_complete' => 0, "important" => 1, "is_delete" => 0])->count();
        $totalComplete = Note::where(['user_name' => 'vnnquang', "is_complete" => 1, "is_delete" => 0])->count();
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
        $data = $request->all();
        $validator = Validator::make($data, [
            'content' => [new NoteRule],
        ]);

        if ($validator->fails()) {
            // Xử lý khi dữ liệu không hợp lệ
            echo $validator->messages();
        } else {
            $note = new Note();
            $note->content = $data['content'];
            $note->is_delete = 0;
            $note->important = 0;
            $note->is_complete = 0;
            $note->user_name = 'vnnquang';
            $note->save();
            return redirect()->route('note.all');
        }
    }

    /**
     * Sửa ghi chú
     *
     * @param Request $request
     * @param [int] $id
     * @return void
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
            echo $validator->messages();
        } else {
            // Update
            Note::where('id', $id)->update(['content' => $data['contentEdit']]);
            return redirect()->route('note.all');
        }
    }

    /**
     * Xóa ghi chú - Xóa mềm
     *
     * @param [int] $id
     * @return void
     */
    public function delete($id)
    {
        Note::where('id', $id)->update(['is_delete' => 1]);
        return redirect()->route('note.all');
    }

    /**
     * Đánh dấu ghi chũ là đã hoàn thành
     *
     * @param Request $request
     * @return void
     */
    public function markComplete(Request $request)
    {
        $data = $request->all();
        foreach ($data as $id => $value) {
            Note::where('id', $id)->update(['is_complete' => 1]);
            break;
        }
        return redirect()->route('note.all');
    }

    /**
     * Đánh dấu ghi chú là quan trọng
     *
     * @param [int] $id
     * @return void
     */
    public function markImportant($id)
    {
        Note::where('id', $id)->update(['important' => 1]);
        return redirect()->route('note.all');
    }

    /**
     * Hủy đánh dấu quan trọng
     *
     * @param [type] $id
     * @return void
     */
    public function unMarkImportant($id)
    {
        Note::where('id', $id)->update(['important' => 0]);
        return redirect()->route('note.all');
    }
}
