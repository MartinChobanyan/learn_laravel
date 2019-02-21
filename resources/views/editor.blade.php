@extends('tplt')

@section('head')
    @parent
    
    <title>Hey! I am player Editor :)</title>
@endsection

@section('body')
    <button class="btn btn-primary" style="margin: 2px" onclick="location.href='/teams/{{ $player->team->id }}'">   Back    </button>
    <br><br>
    
    @includeWhen($errors->any(), 'errors')

        <form class="form-inline" method="POST" action="{{ url()->current() }}"> {{-- /teams/{{ $player->team->id }}/edit/{{ $player->id }}/ --}}
        @csrf
            <div class="form-group">
                <div calss="col-sm">
                    <label for="Name"> Name:   </label>
                        <input class="form-control" type="text" name="name" value="{{ old('name', $player->name) }}" placeholder="PlayerName" min="4" maxlength="15" required autocomplete="off" />
                </div>
                <div class="col-sm">
                    <label for="Nick"> Nick:   </label>
                        <input class="form-control" type="text" name="nick" value="{{ old('nick', $player->nick) }}" placeholder="PlayerNick" min="4" maxlength="15" required autocomplete="off" />
                </div>
            </div>
                <button class="btn btn-primary" style="margin-top: 20px" type="submit">  Save  </button>       
        </form>
@endsection