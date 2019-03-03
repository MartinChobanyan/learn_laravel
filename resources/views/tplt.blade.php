<html>
    <head>
        @section('head')
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <script src="{{ asset('js/app.js') }}"></script>
        @show
    </head>

    <body>
        <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-primary" style="margin-bottom: 11px; opacity: 0.97">
            <a class="navbar-brand" href="{{ url('/') }}/">Amazing App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}/">  Home   </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/teams') }}"> Teams </a>
                    </li>
                </ul>
            </div>
        </nav>

        @yield('body')
    
    </body>
    
    <script>
        $(document).ready(function() {
            $('li.active').removeClass('active');
            $('a[href="' + location.href + '"]').closest('li').addClass('active'); 
        });
    </script>
</html>