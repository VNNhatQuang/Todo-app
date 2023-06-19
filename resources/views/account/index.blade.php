@extends('layouts.app')


@php
    $currentNav = '';
@endphp


@section('content')
    <main>
        {{-- Title --}}
        <div class="title">
            <h2>Thông tin tài khoản</h2>
            <hr>
        </div>

        {{-- Main Content --}}
        <div id="content">
            <form action="" method="POST" id="form-user">
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="user_name">Tên tài khoản</label>
                                <input type="text" class="form-control" id="user_name"
                                    value="{{ session('user')->user_name }}" readonly>
                            </div>
                            <div class="form-group col-8">
                                <label for="full_name">Họ tên</label>
                                <input type="text" class="form-control" id="full_name"
                                    value="{{ session('user')->full_name }}">
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="old_password">Mật khẩu cũ:</label>
                            <input type="password" class="form-control" id="old_password">
                        </div>
                        <div class="form-group col-12">
                            <label for="new_password">Mật khẩu mới:</label>
                            <input type="password" class="form-control" id="new_password">
                        </div>
                        <div class="form-group col-12">
                            <label for="new_password_confirmation">Nhập lại mật khẩu mới:</label>
                            <input type="password" class="form-control" id="new_password_confirmation">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group col-12">
                            <img src="{{ asset('storage/' . session('user')->avatar) }}" class="img-thumbnail" id="preview-image">
                            <input type="file" class="form-control" name="avatar" id="image-input">
                        </div>
                    </div>
                </div>
                <br>
                <div class="float-right mr-3">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
                <div class="float-right mr-3">
                    <button type="button" class="btn btn-info" onclick="location.reload()">Reset</button>
                </div>
            </form>
        </div>

    </main>
@endsection
