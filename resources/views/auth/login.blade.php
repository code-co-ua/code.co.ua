@extends('layouts.app')

@section('title', __('Login'))

@section('content')
<div class="page-single">
    <div class="container">
        <div class="row">
            <div class="col col-login mx-auto">
                <form class="card" action="{{ route('login') }}" method="post" novalidate>
                    @csrf
                    <div class="card-body p-6">
                        <div class="card-title">@lang('Login')</div>

                        <div class="form-group">
                            <label class="form-label" for="email">@lang('E-Mail Address')</label>
                            <input
                                type="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                name="email"
                                id="email"
                                aria-describedby="emailHelp"
                                placeholder="Enter email"
                                value="{{ old('email') }}"
                                required
                                autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                @lang('Password')
                                <a href="{{ route('password.request') }}" class="float-right small">
                                    @lang('Reset Password')
                                </a>
                            </label>
                            <input
                                type="password"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                name="password"
                                id="password"
                                placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    name="remember"
                                    {{ old('remember') ? 'checked' : '' }}/>
                                <span class="custom-control-label">@lang('Remember Me')</span>
                            </label>
                        </div>

                        {!! NoCaptcha::display() !!}

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-block">@lang('Login')</button>
                        </div>
                    </div>
                </form>

                <div class="text-center text-muted">
                    Ще не маєте акаунту? <a href="{{ route('register') }}">@lang('Register')</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
