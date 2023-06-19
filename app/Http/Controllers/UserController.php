<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
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


    public function showRegistrationForm()
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
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $avatarPath = $avatarPath ?? '';

        User::create([
            'user_name' => $request->user_name,
            'full_name' => $request->full_name,
            'password' => Hash::make($request->password),
            'avatar' => $avatarPath,
        ]);

        return redirect('/login')->with('success', 'Registration successful. Please log in.');
    }


    public function showLoginForm()
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
            $request->session()->put('user', $user);
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


    public function showUser(Request $request)
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
     * @return void
     */
    public function Save(Request $request)
    {

    }
}
