@extends('layouts.blank')

@section('title', __('Login'))

@section('body')
    <div class="text-center mb-4">
        <img src="{{ asset('img/idea.svg') }}" alt="Logo" height="36">
    </div>

    <form class="card card-md" action="{{ route('login') }}" method="post">
        @csrf
        <div class="card-body">
            <h2 class="mb-5 text-center">@lang('Login')</h2>

            <div class="mb-3">
                <label class="form-label">@lang('E-Mail Address')</label>
                <input name="email"
                       type="email"
                       class="form-control"
                       placeholder="Email"
                       value="{{ old('email') }}"
                       autocomplete="off">
                @if ($errors->has('email'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="mb-2">
                <label class="form-label">
                    @lang('Password')
                    <span class="form-label-description">
					<a href="{{ route('password.request') }}">@lang('Reset Password')</a>
				</span>
                </label>
                <div class="input-group input-group-flat">
                    <input name="password" type="password" class="form-control" placeholder="@lang('Password')">
                    {{--<div class="input-group-append">
                        <span class="input-group-text">
                            <a href="#"
                               class="link-secondary"
                               title=""
                               data-toggle="tooltip"
                               data-original-title="Show password">
                                @include('svg.eye')
                            </a>
                        </span>
                    </div>--}}
                    @if ($errors->has('password'))
                        <span class="invalid-feedback d-block">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>

            </div>
            <div class="mb-2">
                <label class="form-check">
                    <input type="checkbox"
                           class="form-check-input"
                           {{ old('remember') ? 'checked' : '' }}
                           name="remember">
                    <span class="form-check-label">@lang('Remember Me')</span>
                </label>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block">@lang('Login')</button>
            </div>
        </div>
{{-- TODO - Login with services block (Laravel Socialite integration)
        <div class="hr-text">@lang('Or')</div>

        <div class="card-body">
            <div class="btn-list">
                <a href="#" class="btn btn-secondary btn-block">
                    @include('svg.github')
                    @lang('Login with Github')
                </a>

                <a href="#" class="btn btn-secondary btn-block">
                    @include('svg.github')
                    Login with *Some*
                </a>

            </div>
        </div>
--}}
    </form>

    <div class="text-center text-muted">
        @lang("Don't have account yet?")
        <a href="{{ route('register') }}" tabindex="-1">@lang('Register')</a>
    </div>
@endsection
