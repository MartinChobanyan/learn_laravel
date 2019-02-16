@extends('tplt')

@section('body')

    <button onclick="location.href='/teams'">   Back    </button>

    <h4>
        Name:   {{  $team->name  }}
        <br>
        losung: {{  $team->losung   }}
        <br><br>
        <hr>
        players:
    </h4>

    <table class="table">
        <tr>
            <!-- <th>    ID  </th> -->
            <th>    Name    </th>
            <th>    Nick    </th>
        </tr>
        @foreach($players as $player)
            <tr id="{{ $player->id }}">
                <!-- <td>    {{  $player->id }}   </td> -->
                <td>    <input type="text" name="name" value="{{  $player->name   }}" placeholder="PlayerName" min="8" maxlength="50" disabled>   </td>
                <td>    <input type="text" name="nick" value="{{  $player->nick   }}" placeholder="PlayerNick" min="4" maxlength="15" disabled>   </td>
                <td class="td-button">  <button onclick="location.href='/teams/{{ $team->id }}/edit/{{ $player->id }}'">   Edit    </button>  </td>
            </tr>
        @endforeach
    </table>

    <br>
    <hr>
    
    @includeWhen($errors->any(), 'errors')

    <form method="POST" action="/teams/{{ $id }}/create">
        @csrf

        <input type="text" name="name" placeholder="Name" required />
        <input type="text" name="nick" placeholder="Nick" required />

            <button type="submit">  Create New Player   </button>
    </form>

@endsection