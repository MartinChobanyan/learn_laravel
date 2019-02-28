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
                <td id="name">    {{  $player->name   }}   </td>
                <td id="nick">    {{  $player->nick   }}   </td>
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

<script>

$('#editorModal').on('show.bs.modal', function (e) {
    // init
    var button = $(e.relatedTarget);
    var name = button.data('name'); // takes name's data from table row
    var nick = button.data('nick'); // takes nick's data from table row

    var modal = $(this);
    var input_name = modal.find('.modal-body form input#player-name');
    var input_nick = modal.find('.modal-body form input#player-nick');

    // putting data into Model inputs
    input_name.val(name); 
    input_nick.val(nick);
    //--
    
    // Save
    modal.find('.modal-footer button#Save').click(function(){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var $player_id = button.data('id'); 

        name = input_name.val();
        nick = input_nick.val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },

            type: 'POST',
            url: ('/player/edit/' + $player_id),
            data: {
                'name': name,
                'nick': nick
            },
            success: function(result) {
                input_name.addClass('is-valid');
                input_nick.addClass('is-valid');

                modal.find('.modal-body .alert-danger').hide();

                modal.find('.modal-body .alert-success').html(result.success + '!');
                modal.find('.modal-body .alert-success').show();

                // Updating player data in team's players table
                var player = $('table tr#' + $player_id);
                player.find('td#name').text(name);
                player.find('td#nick').text(nick);
            },
            error: function(result) {
                input_name.addClass('is-valid');
                input_nick.addClass('is-valid');

                modal.find('.modal-body .alert-success').hide();

                modal.find('.modal-body .alert-danger').html(ErrorsHandler(result.responseJSON.errors, ['name', 'nick']));                
                modal.find('.modal-body .alert-danger').show();
            }
        });
    });
    //--
    
    // Inputs
    input_name.keypress(function(){
        InputsLogicOnKeypress('name');
    });

    input_nick.keypress(function(){
        InputsLogicOnKeypress('nick');
    });
    //--

    // Functions
    function InputsLogicOnKeypress(type){
        modal.find('.modal-body input').removeClass('is-valid').removeClass('is-invalid'); // input indicators to default

        modal.find('.modal-body .alert-danger span[for="' + type + '"]').remove(); // removing errors of input
        if(modal.find('.modal-body .alert-danger').text() === '') modal.find('.modal-body .alert-danger').hide(); // Hidding Danger alert if it's empty
        if(modal.find('.modal-body .alert-success').is(':visible')) modal.find('.modal-body .alert-success').hide(); // Hidding Success alert if it's visible
    }

    function ErrorsHandler(errors, types){
        var errors_msg = '';
        types.forEach(function(type){
            if(eval('errors.' + type)){
                eval('input_' + type).removeClass('is-valid').addClass('is-invalid');
                eval('errors.' + type).forEach(function(error) { errors_msg += '<span for="' + type + '">' + '* ' + error + '<br></span>'; });
            }
        });
        return errors_msg;
    }
    //--
});

$('#editorModal').on('hide.bs.modal', function () {
    var modal = $(this);
    
    modal.find('.modal-body form input').removeClass('is-valid').removeClass('is-invalid');
    modal.find('.modal-body .alert').hide();
})

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