@extends('layouts.master')

@section('content')
<div class="page-single">
    <div class="container">
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
                <form class="card" action="{{ route('password.email') }}" method="post" novalidate>
                        @csrf
                        <div class="card-body p-6">
                            <div class="card-title">@lang('Forgot password')</div>

                            <p class="text-muted">@lang('Enter your email address.')</p>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">@lang('Email address')</label>
                                <input
                                    type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    id="email"
                                    name="email"
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
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-block">@lang('Send me new password')</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center text-muted">
                        Forget it, <a href="{{ route('login') }}">send me back</a> to the sign in screen.
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
