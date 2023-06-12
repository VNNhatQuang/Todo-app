<nav id="nav">
    <form action="" method="GET" id="box-search">
        <input type="text" name="searchValue" value="{{ $searchValue }}" placeholder="Tìm kiếm tác vụ">
        <button type="submit" title="Tìm kiếm">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>
    <ul class="list-nav">
        <hr>
        <li>
            <a href="all" class="row all @if ($currentNav === 'all') {{ 'nav-active' }} @endif">
                <i class="fa-solid fa-house"></i>
                <p>Tất cả tác vụ</p>
                @if ($totalAll > 0)
                    <div class="total-note">
                        <span>{{ $totalAll }}</span>
                    </div>
                @endif
            </a>
        </li>
        <hr>
        <li>
            <a href="important" class="row important @if ($currentNav === 'important') {{ 'nav-active' }} @endif">
                <i class="fa-solid fa-star"></i>
                <p>Quan trọng</p>
                @if ($totalImportant > 0)
                    <div class="total-note">
                        <span>{{ $totalImportant }}</span>
                    </div>
                @endif
            </a>
        </li>
        <hr>
        <li>
            <a href="complete" class="row complete @if ($currentNav === 'complete') {{ 'nav-active' }} @endif">
                <i class="fa-solid fa-circle-check"></i>
                <p>Đã hoàn thành</p>
                @if ($totalComplete > 0)
                    <div class="total-note">
                        <span>{{ $totalComplete }}</span>
                    </div>
                @endif
            </a>
        </li>
        <hr>
    </ul>
</nav>
