<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\NavigationService;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $userService;
    protected $navigationService;

    public function __construct(UserService $userService, NavigationService $navigationService)
    {
        $this->middleware('auth')->except(['showRegistrationForm', 'register', 'showLoginForm', 'login']);
        $this->userService = $userService;
        $this->navigationService = $navigationService;
    }


    /**
     * Hiển thị form đăng ký
     *
     * @return View
     */
    public function showRegistrationForm()
    {
        return view('account.register');
    }


    /**
     * Thực hiện đăng ký
     *
     * @param RegisterUserRequest $request
     * @return void
     */
    public function register(RegisterUserRequest $request)
    {
        // Thêm ảnh vào thư mục storage, avatarPath là path ảnh đc lưu vào csdl
        if ($request->file('avatar') != null)
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        else
            $avatarPath = '';
        $this->userService->create([
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
     * @return View
     */
    public function showLoginForm()
    {
        return view('account.login');
    }


    /**
     * Thực hiện đăng nhập
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {     // Sử dụng validated() để lấy dữ liệu đã được validate
            $request->session()->regenerate();
            // Tạo biến session chứa thông tin user đăng nhập
            $user = $this->userService->getUserByID($request->input('user_name'));
            session()->put('user', $user);
            return redirect()->intended('/all');
        }
        return back()
            ->withErrors(['error' => 'The provided credentials do not match our records.'])
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
     * @return View
     */
    public function showUser(Request $request)
    {
        $user = $request->session()->get('user');
        $searchValue = $request->input('searchValue') ?? '';
        // Navigation
        $nav = $this->navigationService->countNoteByID($user->user_name);
        return view('account.index', compact('searchValue', 'nav'));
    }


    /**
     * Lưu lại thông tin cá nhân
     *
     * @param EditUserRequest $request
     * @return RedirectResponse
     */
    public function save(EditUserRequest $request)
    {
        // Kiểm tra mật khẩu cũ có đúng không
        $user = session()->get('user');
        $passwordInput = $request->input('old_password');
        if (Hash::check($passwordInput, $user->password)) {
            // Xử lý ảnh (Thêm ảnh vào thư mục và lấy path ảnh)
            $avatarPath = $user->avatar;
            if ($request->file('avatar') != null)
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
            // Cập nhật
            $this->userService->update(
                $user->user_name,
                [
                    'password' => Hash::make($request->input('new_password')),
                    'avatar' => $avatarPath,
                ]
            );
            // Cập nhật lại biến session
            $newUser = $this->userService->getUserByID($user->user_name);
            session()->put('user', $newUser);
            return back()->with('success', 'Cập nhật thông tin thành công');
        }
        return back()->withErrors(['old_password' => 'The old password is not correct.']);
    }
}
