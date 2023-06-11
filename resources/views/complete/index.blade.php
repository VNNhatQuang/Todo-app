@extends('layouts.app')

@php
    $currentNav = 'complete';
@endphp

@section('content')

    <main>

        {{-- Title --}}
        <div class="title">
            <h2>Đã hoàn thành</h2>
            <hr>
        </div>

        {{-- Main Content --}}
        <div id="content">
            <div class="content-box">
                <form action="" method="GET">
                    @for ($i = 0; $i < 5; $i++)
                        <section class="note">
                            <div class="row">
                                <p class="note-complete">Create Todo app</p>
                            </div>
                            <i class="fa-regular fa-trash-can" title="Xóa"></i>
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
