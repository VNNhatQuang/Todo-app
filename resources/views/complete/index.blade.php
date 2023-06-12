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
                    @foreach ($listNote as $note)
                        <section class="note">
                            <div class="row">
                                <p class="note-complete">{{ $note['content'] }}</p>
                            </div>
                            <i class="fa-regular fa-trash-can" title="Xóa"></i>
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
