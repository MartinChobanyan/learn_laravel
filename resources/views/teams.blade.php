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

        <br>
        <hr>

        @if($errors->any())
            <ol>
                @foreach($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ol>
        @endif

        <form method="POST" action="/teams/create">
        @csrf

            <input type="text" name="team_name" placeholder="Name" required />
            <input type="text" name="team_losung" placeholder="Losung" required />
            <select name="stadium_id" required>
            @foreach($teams as $team)
                <option value="{{ $team->stadium->id }}">{{ $team->stadium->name }}</option>
            @endforeach
            </select>

                <button type="submit">Create New Team</button>
        </form> 

    </body>
</html>