@extends('layouts.app')

@php
    $currentNav = 'important';
@endphp

@section('content')

    <main>

        {{-- Title --}}
        <div class="title">
            <h2>Quan trọng</h2>
            <hr>
        </div>

        {{-- Main Content --}}
        <div id="content">
            <div class="content-box">
                <form action="{{ route('note.important.complete') }}" method="GET">
                    @foreach ($listNote as $note)
                        <section class="note">
                            <div class="row"
                                title="Đã tạo {{ $note->created_at->format('d/m/Y H:i:s') }}
Chỉnh sửa lần cuối {{ $note->updated_at->format('d/m/Y H:i:s') }}">
                                <input type="checkbox" name="{{ $note->id }}" title="Đánh dấu hoàn thành"
                                    onclick="document.querySelector('.content-box>form').submit();">
                                <p>{{ $note->content }}</p>
                            </div>
                            <i class="fa-regular fa-pen-to-square" title="Chỉnh sửa"></i>
                            <a id="delete-note" href="{{ route('note.important.delete', $note->id) }}">
                                <i class="fa-regular fa-trash-can" title="Xóa"></i>
                            </a>
                            <a id="un-mark-important-note" href="{{ route('note.important.unMarkImportant', $note->id) }}">
                                <i class="fa-solid fa-star" title="Hủy đánh dấu quan trọng"></i>
                            </a>
                        </section>
                    @endforeach
                </form>
            </div>
        </div>

        {{-- Pagination --}}
        @include('layouts.pagination')

        {{-- Add Note --}}
        <div class="add-note">
            <form action="{{ route('note.important.create') }}" method="GET" id="box-search" class="box-add-note">
                <input type="text" name="content" placeholder="Thêm tác vụ" required autofocus>
                <button type="submit" title="Thêm mới ghi chú">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </form>
        </div>

    </main>

@endsection
