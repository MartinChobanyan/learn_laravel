@extends('tplt')

@section('body')
<button class="btn btn-primary btn-md" style="margin: 2px" onclick="location.href='/team'">   Back    </button>
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
                <td id="name">{{  $player->name   }}</td>
                <td id="nick">{{  $player->nick   }}</td>
                <td>  <button data-toggle="modal" data-target="#editorModal" data-id="{{ $player->id }}">    Edit </button>  </td>
                <td>  <button data-toggle="modal" data-target="#deletorModal" data-id="{{ $player->id }}"> Del </button> </td>
            </tr>
        @endforeach
        <tbody>
    </table>
</div>
<br>
<hr>

@includeWhen($errors->any(), 'errors')

<form class="form-inline" method="POST" action="/player/create">
    @csrf
    <input type="hidden" name="team_id" value="{{ $team_id }}">

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

<div class="modal fade" id="editorModal" tabindex="-1" role="dialog" aria-labelledby="editorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editorModalLabel">Player Editor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline:none">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success text-success" style="display:none"></div>
        <div class="alert alert-danger text-danger" style="display:none"></div>
        <form>
          <div class="form-group">
            <label for="player-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" id="player-name" placeholder="PlayerName" min="8" maxlength="50" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="player-nick" class="col-form-label">Nick:</label>
            <input type="text" class="form-control" id="player-nick" placeholder="PlayerNick" min="4" maxlength="15" autocomplete="off">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="Close" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="Save">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deletorModal" tabindex="-1" role="dialog" aria-labelledby="deletorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="alert alert-success text-success" style="display:none"></div>
        <div class="alert alert-danger text-danger" style="display:none"></div>
        <h5 id="question">Do you want to delete player?</h5>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" id="Close" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="Delete">Delete</button>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/player-editor.js') }}"></script>
<script src="{{ asset('js/player-deletor.js') }}"></script>

@endsection