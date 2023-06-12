{{-- {{ dd($searchValue) }} --}}
<nav aria-label="...">
    <ul class="pagination justify-content-center">
        <li class="page-item @if ($listNote->currentPage() === 1) {{ 'disabled' }} @endif">
            {{-- <span class="page-link">Previous</span> --}}
            <a class="page-link" href="{{ $listNote->previousPageUrl() }}&searchValue={{ $searchValue }}">Previous</a>
        </li>
        @for ($index = 1; $index <= $listNote->lastPage(); $index++)
            <li class="page-item @if ($index === $listNote->currentPage()) {{ 'active' }} @endif"><a class="page-link" href="?page={{ $index }}&searchValue={{ $searchValue }}">{{ $index }}</a></li>
        @endfor
        <li class="page-item @if ($listNote->currentPage() === $listNote->lastPage()) {{ 'disabled' }} @endif">
            <a class="page-link" href="{{ $listNote->nextPageUrl() }}&searchValue={{ $searchValue }}">Next</a>
        </li>
    </ul>
</nav>
