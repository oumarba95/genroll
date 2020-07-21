@extends('layout.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
                <h1 class="text-center mb-3" style="font-size:22px;">{{ __('Changement de mot de passe') }}</h1>

                <div class="reset-form">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('Adress Email') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Envoyer le lien de changement de mot de passe') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
