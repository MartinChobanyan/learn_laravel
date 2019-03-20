@extends('tplt')

@section('body')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="select" class="col-md-4 col-form-label text-md-right">Phone or Skype</label>

                            <div class="col-md-6">
                                <select class="form-control{{ $errors->has('phone') || $errors->has('skype') ? ' is-invalid' : '' }}" id="PhoneOrEmail" required>
                                    <option>PhoneOrSkype</option>
                                    <option {{ $errors->has('phone') ? 'selected' : '' }}>Phone</option>
                                    <option {{ $errors->has('skype') ? 'selected' : '' }}>Skype</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" style="{{ $errors->has('phone') ? '' : 'display:none' }}">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" data-mask="+(999)99 999-999" placeholder="+(xxx)xx xxx-xxx" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group row" style="{{ $errors->has('skype') ? '' : 'display:none' }}">
                            <label for="skype" class="col-md-4 col-form-label text-md-right">Skype</label>

                            <div class="col-md-6">
                                <input id="skype" class="form-control{{ $errors->has('skype') ? ' is-invalid' : '' }}" name="skype" placeholder="Skype" value="{{ old('skype') }}">
                                @if ($errors->has('skype'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('skype') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    $('select#PhoneOrEmail').on('change', function(e){
        $('select#PhoneOrEmail').removeClass('is-invalid');

        phone_row =  $('label[for="phone"]').closest('div');
        skype_row =  $('label[for="skype"]').closest('div');

        switch(this.value.toLowerCase()){
            case 'phone': 
                phone_row.show();
                skype_row.hide();
                break;
            case 'skype':
                skype_row.show();
                phone_row.hide();
                break;
            default:
                phone_row.hide();
                skype_row.hide();
        }
    });
</script>
@endsection
