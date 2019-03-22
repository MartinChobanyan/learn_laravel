@extends('tplt')

@section('head')
@parent

@endsection

@section('body')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-4">
      <h3 class="display-3">Football</h3>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-7">    
      <h5>Let's make this life better with our Amazing App for Football managers! :)</h5>
    </div>
  </div>
  <div class="row justify-content-center mt-5">
    <div id="posts" class="col">
      <div class="card">
          <div class="card-header">Posts</div>
          
          <div class="card-body">
            @if($posts->isNotEmpty())
              @foreach ($posts->reverse() as $post)
                @include('post')
              @endforeach
            @else
              <h4 class="row justify-content-center display-4">There is no posts to show! :(</h4>
            @endif
          </div>
      </div>
    </div>
  </div>
</div>
@endsection