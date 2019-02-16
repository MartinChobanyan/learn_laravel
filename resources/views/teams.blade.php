@extends('tplt')

@section('body')
    <ul>
        @foreach($teams as $team)
            <li>    
                <a href="/teams/{{ $team->id }}">   {{ $team->name }}   </a>
            </li>
        @endforeach
    </ul>

    <br>
    <hr>
    
    @includeWhen($errors->any(), 'errors')

    <form method="POST" action="/teams/create">
    @csrf

        <input type="text" name="team_name" placeholder="Name" required />
        <input type="text" name="team_losung" placeholder="Losung" required />
        <select name="stadium_id" required>
        @foreach($stadiums as $stadium)
            <option value="{{ $stadium->id }}">{{ $stadium->name }}</option>
        @endforeach
        </select>

            <button type="submit">Create New Team</button>
    </form> 
@endsection