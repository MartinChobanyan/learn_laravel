@extends('tplt')

@section('body')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg">
                <span class="display-4">Searched result: "{{ $data['q'] }}"</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg">
                <b>Players:</b>
                <table class="table table-responsive">
                    <thead>
                        <th>ID</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Nick</th>
                    </thead>
                    <tbody>
                        @foreach ($data['players'] as $player)
                            <tr>
                                <td id="player-id">{{ $player->id }}</td>
                                <td id="player-name">{{ $player->name }}</td>
                                <td id="player-nick">{{ $player->nick }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md">
                <b>Teams:</b>
                <table class="table table-responsive">
                    <thead>
                        <th>ID</th>
                        <th scope="col" class="text-center">Name</th>
                    </thead>
                    <tbody>
                        {{-- @foreach ($teams as $team) --}}
                            <tr>
                                <td id="team-id"></td>
                                <td id="team-name"></td>
                            </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
            <div class="col-md">
                <b>Stadiums:</b>
                <table class="table table-responsive">
                    <thead>
                        <th>ID</th>
                        <th scope="col" class="text-center">Name</th>
                    </thead>
                    <tbody>
                        {{-- @foreach ($data['stadiums'] as $stadium) --}}
                            <tr>
                                <td id="stadium-id"></td>
                                <td id="stadium-name"></td>
                            </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
@endsection