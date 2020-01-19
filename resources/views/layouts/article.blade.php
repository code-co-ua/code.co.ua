@extends('layouts.app')


@section('head')
    <link href="{{ asset('css/articles.css') }}" rel="stylesheet">
    @yield('second_head')
@endsection

@section('content')
    <div class="container">
        <div class="row" id="articles">
            <div class="col-md-9">
                @yield('base_content')
            </div>
            <aside class="col-md-3 left-column">
{{--   TODO         @widget('\Domain\Article\Widgets\Categories')--}}
{{--                @widget('\Domain\Article\Widgets\Tags')--}}
            </aside>
        </div>
    </div>
@endsection
