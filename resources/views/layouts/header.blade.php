<header>
    <div id="app-name">
        <h5>Todo</h4>
    </div>
    <div id="user">
        <i class="fa-solid fa-user"></i>
        &nbsp;
        <i class="fa-solid fa-caret-down"></i>
    </div>
    <div id="user-nav">
        <ul class="user-list-nav">
            <li class="text-center">
                <div class="avatar text-center">
                    <img src="{{ asset('storage/' . session('user')->avatar) }}">
                </div>
            </li>
            <hr>
            <li>
                <a href="account">
                    <i class="fa-solid fa-user"></i>
                    <p>Tài khoản</p>
                </a>
            </li>
            <hr>
            <li>
                <form id="logout" action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <p>Đăng xuất</p>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</header>
