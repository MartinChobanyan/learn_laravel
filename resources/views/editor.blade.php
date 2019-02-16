@extends('tplt')

@section('head')
    @parent
    
    <title>Hey! I am player Editor :)</title>
@endsection

@section('body')
    @includeWhen($errors->any(), 'errors')

    <form method="POST" action="{{ url()->current() }}"> <!-- /teams/{{ $player->team->id }}/edit/{{ $player->id }}/ -->
    @csrf
        Name:
            <input type="text" name="name" value="{{ $player->name }}">
        Nick:
            <input type="text" name="nick" value="{{ $player->nick }}">
                <button type="submit">  Save  </button>
    </form>
@endsection