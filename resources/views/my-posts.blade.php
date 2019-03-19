@extends('tplt')

@section('body')
<div class="container">
    <div class="row justify-content-center">
        <form method="Post" action="{{ route('post-create') }}">
            @csrf

        </form>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @foreach (Auth::user()->posts as $post)
                        @include('post')                
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection