<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

    <body>

        <button onclick="location.href='/teams'">   Back    </button>

        <h4>
            Name:   {{  $team->name  }}
            <br>
            losung: {{  $team->losung   }}
            <br><br>
            <hr>
            players:
        </h4>

        <table>
            <tr>
               <!-- <th>    ID  </th> -->
                <th>    Name    </th>
                <th>    Nick    </th>
            </tr>
            @foreach($players as $player)
                <tr>
                    <!-- <td>    {{  $player->id }}   </td> -->
                    <td>    {{  $player->name   }} </td>
                    <td>    {{  $player->nick   }} </td>
                </tr>
            @endforeach
        </table>

        <br>
        <hr>

        <form method="POST" action="/teams/{{ $id }}/create">
            @csrf

            <input type="text" name="name" placeholder="Name" required />
            <input type="text" name="nick" placeholder="Nick" required />

                <button type="submit">  Create New Player   </button>
        </form>

    </body>
</html>