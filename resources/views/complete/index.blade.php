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
                            <div class="row"
                                title="Đã tạo {{ $note->created_at->format('d/m/Y H:i:s') }}
Đã xóa {{ $note->updated_at->format('d/m/Y H:i:s') }}">
                                <p class="note-complete">{{ $note->content }}</p>
                            </div>
                            <a id="delete-note" href="{{ route('note.complete.delete', $note->id) }}">
                                <i class="fa-regular fa-trash-can" title="Xóa"></i>
                            </a>
                        </section>
                    @endforeach
                </form>
            </div>
        </div>

        {{-- Pagination --}}
        @include('layouts.pagination')

        {{-- Add Note --}}
        {{-- @include('layouts.add-note') --}}

    </main>

@endsection
