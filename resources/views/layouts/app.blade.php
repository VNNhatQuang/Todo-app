<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>
    @include('layouts.library')

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



    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>


</body>

</html>
