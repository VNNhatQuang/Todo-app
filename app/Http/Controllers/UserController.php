<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->except(['showRegistrationForm', 'register', 'showLoginForm', 'login']);
    }


    /**
     * Hiển thị form đăng ký
     *
     * @return void
     */
    public function showRegistrationForm() : View
    {
        return view('account.register');
    }


    /**
     * Thực hiện đăng ký
     *
     * @param Request $request
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255|unique:users',
            'full_name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'image',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Thêm ảnh vào thư mục storage, avatarPath là path ảnh đc lưu vào csdl
        if ($request->file('avatar') != null) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        } else {
            $avatarPath = '';
        }

        User::create([
            'user_name' => $request->user_name,
            'full_name' => $request->full_name,
            'password' => Hash::make($request->password),
            'avatar' => $avatarPath,
        ]);

        return redirect('/login')->with('success', 'Registration successful. Please log in.');
    }


    /**
     * Hiển thị form đăng nhập
     *
     * @return void
     */
    public function showLoginForm() : View
    {
        return view('account.login');
    }


    /**
     * Thực hiện đăng nhập
     *
     * @param Request $request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Tạo biến session chứa thông tin user đăng nhập
            $user = User::where('user_name', $request->input('user_name'))->first();
            session()->put('user', $user);
            return redirect()->intended('/all');
        }
        return back()
            ->withErrors([
                'error' => 'The provided credentials do not match our records.',
            ])
            ->withInput();
    }


    /**
     * Đăng xuất
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Xoá toàn bộ session
        $request->session()->flush();

        return redirect('/login')->with('success', 'Logged out successfully.');
    }


    /**
     * Hiển thị form chỉnh sửa thông tin User
     *
     * @param Request $request
     * @return void
     */
    public function showUser(Request $request) : View
    {
        $user = $request->session()->get('user');

        $searchValue = $request->input('searchValue') ?? '';
        // Navigation
        $totalAll = Note::where(['user_name' => $user->user_name, 'is_complete' => 0, 'is_delete' => 0])->count();
        $totalImportant = Note::where(['user_name' => $user->user_name, 'is_complete' => 0, "important" => 1, "is_delete" => 0])->count();
        $totalComplete = Note::where(['user_name' => $user->user_name, "is_complete" => 1, "is_delete" => 0])->count();
        return view('account.index', compact('searchValue', 'totalAll', 'totalImportant', 'totalComplete'));
    }


    /**
     * Lưu lại thông tin cá nhân
     *
     * @param Request $request
     */
    public function save(Request $request)
    {
        // Validate
        $validator = Validator::make($request->all(), [
            'old_password' => ['required', 'string'],
            'new_password' => ['required', 'string'],
            'new_password_confirm' => ['required', 'string', 'same:new_password'],
            'avatar' => 'image',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator);
        }

        // Kiểm tra mật khẩu cũ có đúng không
        $user_name = session()->get('user')->user_name;
        $password = User::where('user_name', $user_name)->value('password');
        $passwordInput = $request->input('old_password');
        if (Hash::check($passwordInput, $password)) {
            // Handle khóa chính và avatar
            $user_name = session()->get('user')->user_name;
            $avatarPath =  session()->get('user')->avatar;
            if ($request->file('avatar') != null) {
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
            }
            // Cập nhật
            User::where('user_name', $user_name)
                ->update([
                    'password' => Hash::make($request->input('new_password')),
                    'avatar' => $avatarPath,
                ]);
            // Cập nhật lại biến session
            $newUser = User::where('user_name', $user_name)->first();
            session()->put('user', $newUser);

            return back()->with('success', 'Cập nhật thông tin thành công');
        }

        return back()
            ->withErrors([
                'old_password' => 'The old password is not correct.'
            ]);
    }


}
