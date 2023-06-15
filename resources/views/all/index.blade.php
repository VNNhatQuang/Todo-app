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

                @foreach ($listNote as $note)
                    <form class="notes" action="{{ route('note.all.complete') }}" method="GET">
                        {{-- Note Section --}}
                        <section class="note">
                            <div class="row"
                                title="Đã tạo {{ $note->created_at->format('d/m/Y H:i:s') }}
Chỉnh sửa lần cuối {{ $note->updated_at->format('d/m/Y H:i:s') }}">
                                <input type="checkbox" name="{{ $note->id }}" title="Đánh dấu hoàn thành">
                                <p>{{ $note->content }}</p>
                            </div>
                            <a class="edit-note">
                                <i class="fa-regular fa-pen-to-square" title="Chỉnh sửa"></i>
                            </a>
                            <a class="delete-note" href="{{ route('note.all.delete', $note->id) }}">
                                <i class="fa-regular fa-trash-can" title="Xóa"></i>
                            </a>
                            @if ($note->important === 1)
                                <a id="un-mark-important-note" href="{{ route('note.all.unMarkImportant', $note->id) }}">
                                    <i class="fa-solid fa-star" title="Hủy đánh dấu quan trọng"></i>
                                </a>
                            @else
                                <a class="mark-important-note" href="{{ route('note.all.important', $note->id) }}">
                                    <i class="fa-regular fa-star" title="Đánh dấu quan trọng"></i>
                                </a>
                            @endif
                        </section>
                    </form>

                    {{-- Edit Note Form --}}
                    <form action="{{ route('note.all.edit', $note->id) }}" method="GET">
                        <section class="note note-edit-input">
                            <div class="row"
                                title="Đã tạo {{ $note->created_at->format('d/m/Y H:i:s') }}
Chỉnh sửa lần cuối {{ $note->updated_at->format('d/m/Y H:i:s') }}">
                                <input style="margin: 0 2rem; border: none; width: 100%; padding: 0 5px" type="text"
                                    name="contentEdit" id="contentEdit" value="{{ $note->content }}">
                            </div>
                            <button style="border: none; background: #f8f8f8;" class="save-note">
                                <i class="fa-solid fa-check" title="Lưu"></i>
                            </button>
                        </section>
                    </form>
                @endforeach

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
