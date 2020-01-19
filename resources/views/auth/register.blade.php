@extends('layouts.app')

@section('main-class', 'container')

@section('title', __('Register'))

@section('content')
    <div class="row">
        <div class="col col-login mx-auto">
            {{--
            <div class="text-center mb-6">
                <img
                    src="https://tabler.github.io/tabler/demo/brand/tabler.svg"
                    class="h-6"
                    alt="Logo Tabler">
            </div>
            --}}

            <form class="card" action="{{ route('register') }}" method="post">
                @csrf
                <div class="card-body p-6">
                    <div class="card-title">@lang('Register')</div>

                    <div class="form-group">
                        <label class="form-label">@lang('Name')</label>
                        <input type="text"
                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               placeholder="@lang('Name')"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label">@lang('Email')</label>
                        <input
                                type="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                placeholder="@lang('Email')"
                                name="email"
                                value="{{ old('email') }}"
                                required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label">@lang('Password')</label>
                        <input
                                type="password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                placeholder="@lang('Password')"
                                name="password"
                                required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password-confirm">Повторіть пароль</label>
                        <input type="password"
                               class="form-control"
                               placeholder="@lang('Password')"
                               name="password_confirmation"
                               id="password-confirm">
                    </div>

                    {!! NoCaptcha::display() !!}

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block">
                            Зареєструватися
                        </button>
                    </div>
                </div>
            </form>

            <div class="text-center text-muted">
                Вже маєте акаунт? <a href="{{ route('login') }}">Увійти</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! NoCaptcha::renderJs() !!}
@endsection
