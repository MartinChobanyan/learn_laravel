<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-primary" style="margin-bottom: 11px; opacity: 0.97">
    <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">{{ __('header.home') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/team">{{ __('header.teams') }}</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <div class="mr-2" style="margin-top:8">
                <a href="/lang/en"><img src="{{ asset('img/en_flag.png') }}" height="13"></a>
                <a href="/lang/ru"><img src="{{ asset('img/ru_flag.png') }}" height="13"></a>
            </div>
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="/login">{{ __('header.login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="/register">{{ __('header.register') }}</a>
                    </li>
                @endif
            @else
                <form action="{{ route('search') }}" method="GET" class="form-inline mb-0 mr-1">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="search_line" placeholder="{{ __('header.search') }}.." autocomplete="off" required>
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" style="color:floralwhite;border-color:whitesmoke" type="submit">{{ __('header.search') }}</button>
                        </div>
                    </div>
                </form>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" style="outline:none" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile') }}">{{ __('header.profile') }}</a>
                        @if(Auth::user()->hasRole('manager,admin')) <a class="dropdown-item" href="{{ route('my-posts') }}">{{ __('header.my_posts') }}</a> @endif
                        @if(Auth::user()->hasRole('admin')) <a class="dropdown-item" href="{{ route('users') }}">{{ __('header.users') }}</a> @endif
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="return logout()">{{ __('header.logout') }}</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
<script>
    $(document).ready(function() {
        $('li.active').removeClass('active');
        $('a[href="' + location.pathname + '"]').closest('li').addClass('active'); 
    });
    function logout(){
        document.getElementById('logout-form').submit();
        return false;
    }
</script>