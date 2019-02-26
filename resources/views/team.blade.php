@extends('tplt')

@section('head')
@parent

<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('body')
<button class="btn btn-primary btn-md" style="margin: 2px" onclick="location.href='/teams'">   Back    </button>
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
                <!-- <td>    {{  $player->id }}   </td> -->
                <td>    <input class="text-center" type="text" id="name" value="{{  $player->name   }}" disabled>   </td>
                <td>    <input class="text-center" type="text" id="nick" value="{{  $player->nick   }}" disabled>   </td>
                <td>    <button data-toggle="modal" data-target="#editorModal" data-id="{{ $player->id }}" data-name="{{ $player->name }}" data-nick="{{ $player->nick }}">    Edit </button>  </td>
                <td>    <button onclick="del(this.parentElement.parentElement.id)">  Del </button>    </td>
            </tr>
        @endforeach
        <tbody>
    </table>
</div>
<br>
<hr>

@includeWhen($errors->any(), 'errors')

<form class="form-inline" method="POST" action="/player/create/{{ $team_id }}">
    @csrf
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" style="display:none"></div>
        <div class="alert alert-danger" style="display:none"></div>
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

<script>

$('#editorModal').on('show.bs.modal', function (e) {
    // Modal organisation
    var button = $(e.relatedTarget);
    var name = button.data('name');
    var nick = button.data('nick');

    var modal = $(this);
    modal.find('.modal-body form input#player-name').val(name);
    modal.find('.modal-body form input#player-nick').val(nick);
    //--

    modal.find('.modal-footer button#Save').click(function(){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var $player_id = button.data('id'); 
        name = modal.find('.modal-body form input#player-name').val();
        nick = modal.find('.modal-body form input#player-nick').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        });
        $.ajax({
            type: 'POST',
            url: ('/player/edit/' + $player_id),
            async: false, // after debug must be true
            timeout: 8000,
            dataType: 'html',
            data: {
                'name': name,
                'nick': nick
            },
            success: function(result){
                modal.find('.modal-body form .alert-success').show();
                modal.find('.modal-body form .alert-success').html(result.success);

                var player = $('table tr#' + $player_id);
                player.find('input#name').val(name);
                player.find('input#nick').val(nick);
            },
            error: function(result) {
                modal.find('.modal-body form .alert-danger').show();
                modal.find('.modal-body form .alert-danger').html(result.error);
            }
        });
    });

});

function del($player_id){
    if(confirm("Are you sure you want to delete this player?")) 
        location.href = ('/player/delete/' + $player_id);
}

</script>

@if(session('response'))
<script>
    alert({{ session('response') }});
</script>
@endif

@endsection