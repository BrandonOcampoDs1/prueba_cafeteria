@extends('layouts.app') 

@section('login_w')
<body id="body_login">    

<div class="container">
    <div id="card_form_login" class="row justify-content-center">
        <div class="col-md-12">
            <form id="form_login" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row mb-1">
                    <h1 class="text-center fw-bold">CAFETERÍA KONECTA</h1>
                </div>
                <div class="row mb-1">
                    <label for="email" class="col-md-12 col-form-label  ">{{ __('Correo') }}</label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-12 col-form-label">{{ __('Contraseña') }}</label>

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-12 offset-md-12">
                        <button style="width: 100%; letter-spacing: 2px;" type="submit" class="btn btn-primary">
                            {{ __('INGRESAR') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
@endsection
