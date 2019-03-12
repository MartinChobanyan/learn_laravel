@extends('tplt')

@section('body')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">

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
                    <button type="button" class="btn-primary">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection