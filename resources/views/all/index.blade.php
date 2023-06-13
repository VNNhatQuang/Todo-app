@extends('layouts.app')

@php
    $currentNav = 'all';
@endphp

@section('content')
    <main>

        {{-- Title --}}
        <div class="title">
            <h2>Tất cả tác vụ</h2>
            <hr>
        </div>

        {{-- Main Content --}}
        <div id="content">
            <div class="content-box">
                <form action="{{ route('note.all.complete') }}" method="GET">
                    @foreach ($listNote as $note)
                        <section class="note">
                            <div class="row"
                                title="Đã tạo {{ $note->created_at->format('d/m/Y H:i:s') }}
Chỉnh sửa lần cuối {{ $note->updated_at->format('d/m/Y H:i:s') }}">
                                <input type="checkbox" name="{{ $note->id }}" title="Đánh dấu hoàn thành"
                                    onclick="document.querySelector('.content-box>form').submit();">
                                <p>{{ $note->content }}</p>
                            </div>
                            <a id="edit-note" href="{{ route('note.all.edit', $note->id) }}">
                                <i class="fa-regular fa-pen-to-square" title="Chỉnh sửa"></i>
                            </a>
                            <a id="delete-note" href="{{ route('note.all.delete', $note->id) }}">
                                <i class="fa-regular fa-trash-can" title="Xóa"></i>
                            </a>
                            @if ($note->important === 1)
                                <a id="un-mark-important-note" href="{{ route('note.all.unMarkImportant', $note->id) }}">
                                    <i class="fa-solid fa-star" title="Hủy đánh dấu quan trọng"></i>
                                </a>
                            @else
                                <a id="mark-important-note" href="{{ route('note.all.important', $note->id) }}">
                                    <i class="fa-regular fa-star" title="Đánh dấu quan trọng"></i>
                                </a>
                            @endif
                        </section>
                    @endforeach
                </form>
            </div>
        </div>

        {{-- Pagination --}}
        @include('layouts.pagination', compact('listNote', 'searchValue'))

        {{-- Add Note --}}
        <div class="add-note">
            <form action="{{ route('note.all.create') }}" method="GET" id="box-search" class="box-add-note">
                <input type="text" name="content" placeholder="Thêm tác vụ" required autofocus>
                <button type="submit" title="Thêm mới ghi chú">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </form>
        </div>

    </main>
@endsection
