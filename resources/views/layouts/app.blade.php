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
    <nav class="navbar navbar-inverse">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Brand</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}"><i class="fa fa-check-square-o"></i> Welcome Page</a></li>
                    <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i> Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        <li>
                            <a v-link="{path: '/AddRooms'}"><i class="fa fa-plus-circle"></i> Add Room</a>
                        </li>
                        <li>
                            <a v-link="{path: '/MyRooms'}"><i class="fa fa-user"></i> My Rooms</a>
                        </li>
                        <li>
                            <a v-link="{path: '/AllRooms'}"><i class="fa fa-users"></i> All Rooms</a>
                        </li>
                        <li>
                            <a v-link="{path: '/Profile'}"><i class="fa fa-user"></i> {{Auth::user()->name}}</a>
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ url('/login') }}"><i class="fa fa-sign-in"></i> login</a>
                        </li>
                        <li>
                            <a href="{{ url('/register') }}"><i class="fa fa-search-plus"></i> register</a>
                        </li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript">
        $('body').css('overflowY', 'visible');
        $('body').css('overflowX', 'visible');
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
