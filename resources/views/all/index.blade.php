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
                <form action="" method="GET">
                    @for ($i = 0; $i < 5; $i++)
                        <section class="note">
                            <div class="row">
                                <input type="checkbox" name="{{ $i }}" title="Đánh dấu hoàn thành"
                                    onclick="document.querySelector('.content-box>form').submit();">
                                <p>Create Todo app</p>
                            </div>
                            <i class="fa-regular fa-pen-to-square" title="Chỉnh sửa"></i>
                            <i class="fa-regular fa-trash-can" title="Xóa"></i>
                            <i class="fa-regular fa-star" title="Đánh dấu quan trọng"
                                onclick="document.querySelector('.content-box>form').submit();">
                            </i>
                        </section>
                    @endfor
                </form>
            </div>
        </div>

        {{-- Pagination --}}
        @include('layouts.pagination')

        {{-- Add Note --}}
        @include('layouts.add-note')

    </main>

@endsection
