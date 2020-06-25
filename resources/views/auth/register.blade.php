@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col s12 m12 l2"></div>
    <div class="col s12 m12 l8">
        <form method="POST" action="{{ route('register') }}" class="col s12">
            @csrf
            <div class="card">
                <div class="row card-content">
                    <div class="row">
                        <div class="col s6">
                            <span class="card-title">{{ __('Register') }}</span>
                        </div>
                        <div class="col s6">
                            <a id="volverButton"
                                class="btn tooltipped btn-floating btn-medium waves-effect waves-light red" href="{{ route('welcome') }}"
                                data-position="left" data-tooltip="Volver al inicio">
                                <i class="material-icons">undo</i>
                            </a>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" id="name"
                                class="validate form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" autocomplete="name">
                            <label for="name">{{ __('Name') }}</label>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

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
                                autocomplete="new-password">
                            <label for="password">{{ __('Password') }}</label>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="input-field col s12">
                            <input id="password-confirm" type="password" class="validate form-control"
                                name="password_confirmation" autocomplete="new-password">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn waves-effect waves-light" type="submit">{{ __('Register') }}</button>
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