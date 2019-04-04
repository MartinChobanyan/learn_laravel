@extends('tplt')

@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
                <table class="table table-responsive">
                    <thead>
                        <!-- <th>    ID  </th> -->
                        <th scope="col" class="text-center">    Name    </th>
                        <th scope="col" class="text-center">    Email   </th>
                        <th scope="col" class="text-center">    Phone   </th>
                        <th scope="col" class="text-center">    Skype   </th>
                        <th scope="col" class="text-center">    Roles   </th>
                        <th scope="col" class="text-center" colspan="2">    Options </th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr id="{{ $user->id }}">
                                <td id="name">{{ $user->name }}</td>
                                <td id="email">{{ $user->email }}</td>
                                <td id="phone">{{ $user->phone }}</td>
                                <td id="skype">{{ $user->skype }}</td>
                                <td id="roles">{{ $user->roles }}</td>
                                <td>  <button data-toggle="modal" data-target="#editorModal" data-id="{{ $user->id }}"> Edit </button>  </td>
                                <td>  <button data-toggle="modal" data-target="#deletorModal" data-id="{{ $user->id }}">  Del </button> </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editorModal" tabindex="-1" role="dialog" aria-labelledby="editorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editorModalLabel">User Editor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline:none">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success text-success" style="display:none"></div>
                    <div class="alert alert-danger text-danger" style="display:none"></div>
                    <form id="editor-form">
                        <div class="form-group">
                            <label for="user-name" class="col-form-label">Name:</label>
                            <input type="text" name="name" class="form-control" placeholder="UserName" min="8" maxlength="50" autocomplete="off" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="user-email" class="col-form-label">Email:</label>
                            <input type="text" name="email" class="form-control" placeholder="UserEmail" min="4" maxlength="255" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="user-phone" class="col-form-label">Phone:</label>
                            <input type="text" name="phone" class="form-control" data-mask="+(999)99 999-999" placeholder="UserPhone" min="6" maxlength="20" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="user-skype" class="col-form-label">Skype:</label>
                            <input type="text" name="skype" class="form-control" placeholder="UserSkype" min="4" maxlength="100" autocomplete="off">
                        </div>
                        {{-- <div class="form-group">
                            <label for="user-roles" class="col-form-label">Roles:</label>
                            <input name="roles" class="form-control">
                        </div> --}}
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
                    <h5 id="question" style="word-wrap:break-word">Do you want to delete user?</h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" id="Close" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="Delete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="{{ asset('js/user-editor.js') }}"></script>
    <script src="{{ asset('js/user-deletor.js') }}"></script>
@endsection