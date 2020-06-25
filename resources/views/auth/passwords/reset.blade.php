@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col s12 m12 l2"></div>
    <div class="col s12 m12 l8">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <div class="card">
                <div class="row card-content">
                    <span class="card-title">{{ __('Reset Password') }}</span>
                    <div class="divider"></div>

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-field col s12">
                        <input id="email" type="email"
                            class="validate form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ $email ?? old('email') }}" autocomplete="email">
                        <label for="email">{{ __('E-Mail Address') }}</label>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-field col s12">
                        <input id="password" type="password"
                            class="validate form-control @error('password') is-invalid @enderror" name="password" required
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
                                name="password_confirmation" required autocomplete="new-password">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    </div>
                </div>
                <div class="card-action">
                    <button type="submit" class="btn waves-effect waves-light">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col s12 m12 l2"></div>
</div>
@endsection