@extends('tplt')

@section('body')

<button class="btn btn-primary btn-md" style="margin: 2px" onclick="location.href='/teams'">   Back    </button>
<br><br>

<h4>
    Name:   {{  $team->name  }}
    <br>
    losung: {{  $team->losung   }}
    <br><br>
    <hr>
    players:
</h4>
<br>
<div class="col-md-1 col-md-offset-3">
    <table class="table table-sm">
        <thead>
            <tr>
                <!-- <th>    ID  </th> -->
                <th scope="col" class="text-center">    Name    </th>
                <th scope="col" class="text-center">    Nick    </th>
            </tr>
        </thead>
        <tbody>
        @foreach($players as $player)
            <tr id="{{ $player->id }}">
                <!-- <td>    {{  $player->id }}   </td> -->
                <td>    <input class="text-center" type="text" name="name" value="{{  $player->name   }}" placeholder="PlayerName" min="8" maxlength="50" autocomplete="off" disabled>   </td>
                <td>    <input class="text-center" type="text" name="nick" value="{{  $player->nick   }}" placeholder="PlayerNick" min="4" maxlength="15" autocomplete="off" disabled>   </td>
                <td>  <button onclick="location.href='/teams/{{ $team->id }}/edit/{{ $player->id }}'">   Edit    </button>  </td>
            </tr>
        @endforeach
        <tbody>
    </table>
</div>
<br>
<hr>

@includeWhen($errors->any(), 'errors')

<form class="form-inline" method="POST" action="/teams/{{ $id }}/create">
    @csrf
    <div class="form-row" style="margin: 2px">
        <div class="col-md">
            <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="PlayerName" min="4" maxlength="15" autocomplete="off" required />
        </div>
        <div class="col-md">
            <input class="form-control" type="text" name="nick" value="{{ old('nick') }}" placeholder="PlayerNick" min="4" maxlength="15" autocomplete="off" required />
        </div>
    </div>
        <button class="btn btn-primary btn-sm" type="submit">  Create New Player   </button>
</form>

@endsection