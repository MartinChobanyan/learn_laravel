<ul>
@foreach($teams as $team)
<li style="margin-top: 3px"><a style="text-decoration:none" href="teams/{{ $team->id }}">{{ $team->name }}</a></li>
@endforeach
</ul>