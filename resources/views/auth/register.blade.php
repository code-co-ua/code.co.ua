@extends('layouts.blank')

@section('title', __('Register'))

@section('body')
    <div class="text-center mb-4">
        <img src="{{ asset('img/idea.svg') }}" alt="Logo" height="36">
    </div>

    <form class="card card-md" action="{{ route('register') }}" method="post">
        @csrf
        <div class="card-body">
            <h2 class="mb-5 text-center">@lang('Register')</h2>

            <div class="mb-3">
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
            <div class="mb-3">
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
            <div class="mb-3">
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
            <div class="mb-3">
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
@endsection

@section('scripts')
    {!! NoCaptcha::renderJs() !!}
@endsection
