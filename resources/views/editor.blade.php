@extends('tplt')

@section('head')
    @parent
    
    <title>Hey! I am player Editor :)</title>
@endsection

@section('body')
    <button onclick="location.href='/teams/{{ $player->team->id }}'">   Back    </button>

    <br><br>
    @includeWhen($errors->any(), 'errors')

    <form method="POST" action="{{ url()->current() }}"> {{-- /teams/{{ $player->team->id }}/edit/{{ $player->id }}/ --}}
    @csrf
        Name:
            <input type="text" name="name" value="{{ old('name', $player->name) }}" placeholder="PlayerName" min="4" maxlength="15" required />
        Nick:
            <input type="text" name="nick" value="{{ old('nick', $player->nick) }}" placeholder="PlayerNick" min="4" maxlength="15" required />
                <button type="submit">  Save  </button>
    </form>
@endsection