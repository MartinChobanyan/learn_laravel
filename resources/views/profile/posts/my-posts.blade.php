@extends('tplt')

@section('body')
@includeWhen(session('success'), 'notification', ['notify_message' => session('success')])

<div class="container mb-3">
    <div class="row justify-content-end mb-3">
        <button class="btn btn-primary" id="addPost" style="{{ $errors->isEmpty() ? '' : 'display:none' }}">+ Add Post</button>
    </div>

    <div class="row justify-content-center">
        
        <div id="postCreate" class="col-md-10 mb-3" style="{{ $errors->isEmpty() ? 'display:none' : '' }}">
            <div class="card">
                <div class="card-header">Create Post</div>

                <div class="card-body">
                    <form enctype="multipart/form-data" method="POST" action="{{ route('post-store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="PostTitle">Title:</label>
                            <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" placeholder="Post Title" value="{{ old('title') }}" min="3" maxlength="80" autocomplete="off">
                            
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="PostPhoto">Photo:</label>
                            <input type="file" class="form-control{{ $errors->has('photo') ? ' is-invalid' : '' }}" name="photo">
                            
                            @if ($errors->has('photo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="PostContent">Content:</label>
                            <textarea class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" rows="6" max-length="700">{{ old('content') }}</textarea>
                            
                            @if ($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>
                            <button type="submit" class="btn btn-primary float-right">Create New Post</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="posts" class="col-md-13">
            <div class="card">
                <div class="card-header">Posts</div>
                
                <div class="card-body">
                    @if(($posts = Auth::user()->posts)->isNotEmpty())
                        @foreach ($posts->reverse() as $post)
                            <div id="buttons-{{ $post->id }}" class="col-md-1 float-right ml-1 mr-1">
                                <div class="row mb-1">
                                    <button data-toggle="modal" data-target="#editorModal" data-id="{{ $post->id }}" class="btn btn-secondary btn-sm">Edit</button>
                                </div>
                                <div class="row">
                                    <button data-toggle="modal" data-target="#deletorModal" data-id="{{ $post->id }}" class="btn btn-secondary btn-sm">Del</button>
                                </div>
                            </div>
                            @include('profile/posts/post')                
                        @endforeach
                    @else
                        <h4 class="display-4">There is no posts to show! :(</h4>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="editorModal" tabindex="-1" role="dialog" aria-labelledby="editorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editorModalLabel">Post Editor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline:none">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success text-success" style="display:none"></div>
                <div class="alert alert-danger text-danger" style="display:none"></div>
                <form id="editor-form">
                    <div class="form-group">
                        <label for="post-title" class="col-form-label">Title:</label>
                        <input type="text" class="form-control" id="post-title" name="title" placeholder="Post Title" min="3" maxlength="80" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="post-photo" class="col-form-label">Photo:</label>
                        <input type="text" class="form-control" id="post-photo" name="photo" placeholder="http://example.com/.../*.(jpg,png..etc)" min="5" maxlength="150" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="post-content" class="col-form-label">Content:</label>
                        <textarea class="form-control" id="post-content" name="content" rows="6" max-length="700"></textarea>
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
                    <h5 id="question">Do you want to delete post?</h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" id="Close" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="Delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/post-deletor.js') }}"></script>
<script src="{{ asset('js/post-editor.js') }}"></script>
<script>
    $('#addPost').click(function(){
        $(this).slideUp(500);
        $('div#postCreate').show(500);
    });
</script>
@endsection