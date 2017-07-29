<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="_token" value="{{ csrf_token() }}">
    <title>Laravel</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body id="app-layout">
    <div class="container-fluid">
        <div class="row">
            <div class="mail-box">
                @include('includes.sidebar')
                <aside class="lg-side">
                    <div class="inbox-head">
                        <h3>My Realtime Chat Application</h3>
                    </div>
                    <div class="inbox-body">
                        @yield('content')
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
