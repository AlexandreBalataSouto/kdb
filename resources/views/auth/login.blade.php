@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col s12 m12 l2"></div>
    <div class="col s12 m12 l8">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="card">
                <div class="row card-content">
                    <div class="row">
                        <div class="col s6">
                            <span class="card-title">{{ __('Login') }}</span>
                        </div>
                        <div class="col s6">
                            <a id="volverButton"
                                class="btn tooltipped btn-floating btn-medium waves-effect waves-light red"
                                href="{{ route('welcome') }}" data-position="left" data-tooltip="Volver al inicio">
                                <i class="material-icons">undo</i>
                            </a>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email"
                                class="validate form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" autocomplete="email">
                            <label for="email">{{ __('E-Mail Address') }}</label>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-field col s12">
                            <input id="password" type="password"
                                class="validate form-control @error('password') is-invalid @enderror" name="password"
                                autocomplete="current-password">
                            <label for="password">{{ __('Password') }}</label>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-action">
                    <div class="row">
                        <div class="col s12 m12 l8">
                            <button type="submit" class="btn waves-effect waves-light">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                            <a class="btn waves-effect waves-light" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="boxGifLoading">
                    <img src="{{URL::asset('img/loading.gif')}}" alt="loadingGif">
                </div>
            </div>
        </form>
    </div>
    <div class="col s12 m12 l2"></div>
</div>

@endsection