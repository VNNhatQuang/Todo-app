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
                <form action="" method="GET">
                    @foreach ($listNote as $note)
                        <section class="note">
                            <div class="row">
                                <input type="checkbox" name="{{ $note['id'] }}" title="Đánh dấu hoàn thành"
                                    onclick="document.querySelector('.content-box>form').submit();">
                                <p>{{ $note['content'] }}</p>
                            </div>
                            <i class="fa-regular fa-pen-to-square" title="Chỉnh sửa"></i>
                            <i class="fa-regular fa-trash-can" title="Xóa"></i>
                            <i class="fa-solid fa-star" title="Đánh dấu quan trọng"
                                onclick="document.querySelector('.content-box>form').submit();">
                            </i>
                        </section>
                    @endforeach
                </form>
            </div>
        </div>

        {{-- Pagination --}}
        @include('layouts.pagination')

        {{-- Add Note --}}
        @include('layouts.add-note')

    </main>

@endsection
