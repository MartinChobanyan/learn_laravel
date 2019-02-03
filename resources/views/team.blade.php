<button onclick="location.href='/teams'">Back</button>
<h4>
    Name: {{ $team->name }}
    <br>
    losung: {{ $team->losung }}
    <br><br><hr>
    players:
</h4>
<ol>
@foreach($players as $player)
<li style="margin: 3px;font-size:18px">{{ $player->name }}</li>
@endforeach
</ol>