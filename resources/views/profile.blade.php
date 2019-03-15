@extends('tplt')

@section('body')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body" id="{{ Auth::user()->id }}">

                    <h6> 
                        <strong>Name:</strong> <span id="name">{{ Auth::user()->name }}</span>
                            <br>

                        @if(Auth::user()->phone) 
                            <strong>Phone:</strong> <span id="phone">{{ Auth::user()->phone }}</span>
                        @else
                            <strong>Skype:</strong> <span id="skype">{{ Auth::user()->skype }}</span>
                        @endif
                            <br>

                        <strong>Email:</strong> <span id="email">{{ Auth::user()->email }}</span>
                            <br> 
                        <strong>Password:</strong> &#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;
                    </h6>

                    <button type="button" class="btn-primary" data-toggle="modal" data-target="#editorModal" data-id="{{ Auth::user()->id }}">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editorModal" tabindex="-1" role="dialog" aria-labelledby="editorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editorModalLabel">Profile Editor</h5>
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
                        <input type="text" name="name" class="form-control" id="user-name" placeholder="UserName" min="8" maxlength="50" autocomplete="off" autofocus>
                    </div> 
                    <div class="form-group">
                        <label for="user-phone" class="col-form-label">Phone:</label>
                        <input type="text" name="phone" class="form-control" id="user-phone" data-mask="+(999)99 999-999" placeholder="UserPhone" min="6" maxlength="20" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="user-skype" class="col-form-label">Skype:</label>
                        <input type="text" name="skype" class="form-control" id="user-skype" placeholder="UserSkype" min="4" maxlength="100" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="user-email" class="col-form-label">Email:</label>
                        <input type="text" name="email" class="form-control" id="user-email" placeholder="UserEmail" min="4" maxlength="255" autocomplete="off">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="{{ asset('js/profile-editor.js') }}"></script>

@endsection