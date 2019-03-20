@extends('tplt')

@section('body')
<div class="container mb-3">
    <div class="row justify-content-end mb-3">
        <button class="btn btn-primary" id="addPost" style="{{ $errors->isEmpty() ? '' : 'display:none' }}">+ Add Post</button>
    </div>

    <div class="row justify-content-center">
        
        <div id="postCreate" class="col-md-10 mb-3" style="{{ $errors->isEmpty() ? 'display:none' : '' }}">
            <div class="card">
                <div class="card-header">Create Post</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('post-store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="PostTitle">Title:</label>
                            <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" placeholder="Post Title">
                            
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="PostPhoto">Photo:</label>
                            <input type="text" class="form-control{{ $errors->has('photo') ? ' is-invalid' : '' }}" name="photo" placeholder="http://example.com/.../*.(jpg,png..etc)">
                            
                            @if ($errors->has('photo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="PostContent">Content:</label>
                            <textarea class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" rows="6"></textarea>
                            
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

        <div class="col-md-13">
            <div class="card">
                <div class="card-header">Posts</div>
                
                <div class="card-body">
                    @if(($posts = Auth::user()->posts)->isNotEmpty())
                        @foreach ($posts->reverse() as $post)
                            @include('post')                
                        @endforeach
                    @else
                        <h4 class="display-4">There is no posts to show! :(</h4>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $('#addPost').click(function(){
        $(this).slideUp(500);
        $('div#postCreate').show(500);
    });
</script>
@endsection