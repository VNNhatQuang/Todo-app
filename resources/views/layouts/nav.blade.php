<nav id="nav">
    <form action="" method="GET" id="box-search">
        <input type="text" name="searchValue" placeholder="Tìm kiếm tác vụ">
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
            </a>
        </li>
        <hr>
        <li>
            <a href="important" class="row important @if ($currentNav === 'important') {{ 'nav-active' }} @endif">
                <i class="fa-solid fa-star"></i>
                <p>Quan trọng</p>
            </a>
        </li>
        <hr>
        <li>
            <a href="complete" class="row complete @if ($currentNav === 'complete') {{ 'nav-active' }} @endif">
                <i class="fa-solid fa-circle-check"></i>
                <p>Đã hoàn thành</p>
            </a>
        </li>
        <hr>
    </ul>
</nav>
