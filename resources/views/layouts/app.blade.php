<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>
    <link rel="icon" href="{{ asset('img/icon.png') }}" />
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    {{-- JQUERY --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>

    <div id="main">

        {{-- HEADER --}}
        @include('layouts.header')


        <div class="row">
            {{-- NAVIGATION --}}
            @include('layouts.nav', compact('currentNav'))

            {{-- CONTENT --}}
            @yield('content')
        </div>



        {{-- FOOTER --}}
        @include('layouts.footer')

    </div>


    <script>
        $(document).ready(function() {
            $('#box-search').submit(function(event) {
                event.preventDefault(); // Ngăn chặn form gửi yêu cầu mặc định

                var formData = $(this).serialize(); // Lấy dữ liệu từ form

                $.ajax({
                    type: 'GET',
                    url: $('#box-search').attr('action'), // Thay đổi thành URL của controller xử lý tìm kiếm
                    data: formData,
                    success: function(response) {
                        $("#main").html(response);
                    },
                    error: function(error) {
                        alert("Your request is not valid!");
                    }
                });
            });
        });
    </script>



    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="{{ asset('js/ajax.js') }}"></script> --}}


</body>

</html>
