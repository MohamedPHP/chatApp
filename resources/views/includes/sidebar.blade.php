<aside class="sm-side">
    @if (Auth::check())
        <div class="user-head">
            <div class="user-name">
                <h5><a href="#">{{ Auth::user()->name }}</a></h5>
                <span><a href="#">{{ Auth::user()->email }}</a></span>
            </div>
        </div>
    @endif
    @if (!Auth::check())
        <div class="user-head">
            <div class="user-name">
                <h5><a href="#">Welcome To Chat Application</a></h5>
                <span><a href="{{ url('/login') }}">Login</a> Or <a href="{{ url('/register') }}">Register</a></span>
            </div>
        </div>
    @endif
    <br><br>

    @if (Auth::check())
        <ul class="inbox-nav inbox-divider">
            <li class="">
                <a href="{{ url('/logout') }}"><i class="fa fa-share"></i> logout</a>
            </li>
        </ul>
    @endif
</aside>
