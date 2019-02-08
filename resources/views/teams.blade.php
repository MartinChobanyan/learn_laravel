<html>

    <head>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

    <body>
        <ul>
            @foreach($teams as $team)
                <li>    
                    <a href="/teams/{{ $team->id }}">   {{ $team->name }}   </a>
                </li>
            @endforeach
        </ul>
        <!--
        <br>
        <hr>

        <form method="POST" action="/teams/create">
        @csrf

            <input type="text" name="name" placeholder="Name" required />
            <input type="text" name="losung" placeholder="Losung" required />
            <input type="text" name="stadium" placeholder="Stadium name" required />

                <button type="submit">Create New Team</button>
        </form> 
        -->
    </body>
</html>