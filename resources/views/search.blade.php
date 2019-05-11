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
                        <th scope="col" class="text-center">Name</th>
                    </thead>
                    <tbody>
                        @foreach ($data['search_results'] as $search_result)
                            @if($search_result->type == 'player')
                                <tr>
                                    <td id="player-name">{{ $search_result->name }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md">
                <b>Teams:</b>
                <table class="table table-responsive">
                    <thead>
                        <th scope="col" class="text-center">Name</th>
                    </thead>
                    <tbody>
                        @foreach($data['search_results'] as $search_result)
                            @if($search_result->type == 'team')
                                <tr>
                                    <td id="team-name">{{ $search_result->name }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md">
                <b>Stadiums:</b>
                <table class="table table-responsive">
                    <thead>
                        <th scope="col" class="text-center">Name</th>
                    </thead>
                    <tbody>
                        @foreach($data['search_results'] as $search_result)
                            @if($search_result->type == 'stadium')
                                <tr>
                                    <td id="stadium-name">{{ $search_result->name }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection