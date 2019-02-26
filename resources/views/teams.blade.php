@extends('tplt')

@section('body')
<h4 style="margin: 2px">Teams:</h4>
<br>

<div class="col-md-2">
    <div class="list-group">
        @foreach($teams as $team)
            <a class="list-group-item text-center" href="/team/{{ $team->id }}">   {{ $team->name }}   </a>
         @endforeach
    </div>
</div>
<br>
<hr>

@includeWhen($errors->any(), 'errors')

<form class="form-inline" method="POST" action="/team/create">
@csrf
    <div class="form-row" style="margin: 2px">
        <div class="col-md">
            <input class="form-control" type="text" name="team_name" value="{{ old('team_name') }}" placeholder="Name" autocomplete="off" required />
        </div>
        <div class="col-md">
            <input class="form-control" type="text" name="team_losung" value="{{ old('team_losung') }}" placeholder="Losung" autocomplete="off" required />
        </div>
        <div class="col-md">
            <select class="form-control" name="stadium_id" required>
                <option value="">   Stadium    </option> 
                @foreach($stadiums as $stadium)
                    <option value="{{ $stadium->id }}" 
                        @if(old('stadium_id') == $stadium->id))
                            selected
                        @endif
                    >{{ $stadium->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
        <button class="btn btn-primary btn-sm" type="submit">Create New Team</button>
</form> 
@endsection