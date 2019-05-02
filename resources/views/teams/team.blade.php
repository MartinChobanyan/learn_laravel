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
<div class="row" style="position:relative;width:100%;margin-left:30">
  <div>
    <table class="table table-sm" style="position:inherit">
        <thead>
            <tr>
              <!-- <th>    ID  </th> -->
              <th scope="col" class="text-center">    Name    </th>
              <th scope="col" class="text-center">    Nick    </th>
              <th scope="col" class="text-center">    Roles    </th>
              <th scope="col" class="text-center">    Salary    </th>
              @if(Auth::user()->hasRole('manager,admin'))
                <th scope="cols" class="text-center" colspan="2">  Options </th>
                <th scope="col" class="text-center">  Contract </th>
              @endif
            </tr>
        </thead>
        <tbody>
        @foreach($players as $player)
          @if(!Auth::user()->hasRole('manager,admin') && !$player->contract) 
            @continue 
          @endif
          <tr id="{{ $player->id }}" @if(!$player->contract) style="background-color:lightgrey" @endif>
            <td id="name">{{  $player->name   }}</td>
            <td id="nick">{{  $player->nick   }}</td>
            <td id="role">{{  $player->role->name }}</td>
            <td id="salary">{{  intval($player->salary).'.00$' }}</td>
            @if(Auth::user()->hasRole('manager,admin'))
              <td>  <button data-toggle="modal" data-target="#editorModal" data-id="{{ $player->id }}"> Edit </button>  </td>
              <td>  <button data-toggle="modal" data-target="#deletorModal" data-id="{{ $player->id }}">  Del </button> </td>
              <td>  <button data-toggle="modal" data-target="#contractModal" data-id="{{ $player->id }}">{{ $player->contract ? 'Show' : 'Upload' }}</button> </td>
            @endif
          </tr>
        @endforeach
        <tbody>
    </table>
  </div>
  <div class="ml-5"><canvas id="salaryChart" width="350" height="250"></canvas></div><span class="pull-right">Total salary: {{ $total_salary }}.00$</span>
</div>
<hr>

@if(Auth::user()->hasRole('manager,admin'))
  @includeWhen($errors->any(), 'errors')

  <form class="form-inline" method="POST" action="/player/create">
      @csrf
      <input type="hidden" name="team_id" value="{{ $team_id }}">

      <div class="form-row" style="margin: 2px">
          <div class="col-xs">
            <input class="form-control" type="text" name="name" value="{{ old('name') ? old('name') : $rand_player->name() }}" placeholder="PlayerName" min="4" maxlength="15" autocomplete="off" required />
          </div>
          <div class="col-xs">
            <input class="form-control" type="text" name="nick" value="{{ old('nick') ? old('nick') : $rand_player->surname() }}" placeholder="PlayerNick" min="4" maxlength="15" autocomplete="off" required />
          </div>
          <div class="col-xs">
            <select class="form-control" name="role_id" required>
              <option value="">   Role    </option> 
              @foreach($roles as $role)
                  <option value="{{ $role->id }}" 
                      @if(old('role_id') == $role->id))
                          selected
                      @endif
                  >{{ $role->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-xs">
            <div class="input-group">
              <input class="form-control" type="number" name="salary" value="{{ old('salary') }}" placeholder="PlayerSalary" min="0" max="999999999999" maxlength="12" autocomplete="off">
              <div class="input-group-append">
                <span class="input-group-text">.00</span>
                <span class="input-group-text">$</span>
              </div>
            </div>
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
          <form id="editor-form">
            <div class="form-group">
              <label for="player-name" class="col-form-label">Name:</label>
              <input type="text" name="name" class="form-control" id="player-name" placeholder="PlayerName" min="8" maxlength="50" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="player-nick" class="col-form-label">Nick:</label>
              <input type="text" name="nick" class="form-control" id="player-nick" placeholder="PlayerNick" min="4" maxlength="15" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="player-role" class="col-form-label">Role:</label>
              <select class="form-control" name="role_id">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" 
                        @if(old('role_id') == $role->id))
                            selected
                        @endif
                    >{{ $role->name }}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group">
              <label for="player-salary" class="col-form-label">Salary:</label>
              <div class="input-group">
                <input type="number" name="salary" class="form-control" id="player-salary" placeholder="PlayerSalary" min="0" max="999999999999" maxlength="12" autocomplete="off">
                <div class="input-group-append">
                  <span class="input-group-text">.00</span>
                  <span class="input-group-text">$</span>
                </div>
              </div>
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
          <h5 id="question" style="word-wrap:break-word">Do you want to delete player?</h5>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" id="Close" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="Delete">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="contractModal" tabindex="-1" role="dialog" aria-labelledby="contractModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editorModalLabel">  Contract  </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline:none">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body">
          <div class="alert alert-success text-success" style="display:none"></div>
          <div class="alert alert-danger text-danger" style="display:none"></div>
          <div id="additional">
            {{-- Content --}}
          </div>
        </div>
        <div class="modal-footer justify-content-center">
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/player-editor.js') }}"></script>
  <script src="{{ asset('js/player-deletor.js') }}"></script>
  <script src="{{ asset('js/player-contract.js') }}"></script>
@endif

@component('chart', [
                      'chartElementSelector' => '#salaryChart',
                      'data' => $chart_data
                    ]
          )
  @slot('additionalScript')
    <script>
      function updateChart(){
        Chart.data.labels.forEach((label, i) => {
          let sum = 0;
          $('table tr').find('td:contains("' + label + '")').parent().map((j, el) => {
            sum += parseInt($(el).children('td#salary').text());
          });
          Chart.data.datasets[0].data[i] = sum;
        });
        Chart.update({
          duration: 1000,
          easing: 'easeOutSine'
        });
      }
    </script>
  @endslot
@endcomponent

@endsection