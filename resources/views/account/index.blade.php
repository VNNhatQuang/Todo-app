@extends('layouts.app')


@php
    $currentNav = '';
@endphp


@section('content')
    <main>
        {{-- Title --}}
        <div class="title">
            <div class="row title-child">
                <h2>Thông tin tài khoản</h2>
                @if (session('success') != null)
                    <span style="color: green;">{{ session('success') }}</span>
                @endif
            </div>
            <hr>
        </div>

        {{-- Main Content --}}
        <div id="content">
            <form action="{{ route('user.save') }}" method="post" id="form-user" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="user_name">Tên tài khoản</label>
                                <input type="text" class="form-control" id="user_name"
                                    value="{{ session('user')->user_name }}" name="user_name" disabled>
                                @error('user_name')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-8">
                                <label for="full_name">Họ tên</label>
                                <input type="text" class="form-control" id="full_name"
                                    value="{{ session('user')->full_name }}" name="full_name" disabled>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="old_password">Mật khẩu cũ:</label>
                            <input type="password" class="form-control" id="old_password" name="old_password">
                            @error('old_password')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="new_password">Mật khẩu mới:</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                            @error('new_password')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="new_password_confirm">Nhập lại mật khẩu mới:</label>
                            <input type="password" class="form-control" id="new_password_confirm"
                                name="new_password_confirm">
                            @error('new_password_confirm')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group col-12">
                            <img src="{{ asset('storage/' . session('user')->avatar) }}" class="img-thumbnail"
                                id="preview-image">
                            <input type="file" class="form-control" name="avatar" id="image-input">
                            @error('avatar')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <hr>
                        <div class="float-right mr-3">
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                        <div class="float-right mr-3">
                            <button type="button" class="btn btn-info" onclick="location.reload()">Reset</button>
                        </div>
                    </div>
                </div>
                <br>

            </form>
        </div>

    </main>
@endsection
