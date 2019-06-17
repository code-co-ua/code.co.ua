@extends('layouts.exercise')

@section('title', $exercise->title)

{{--@section('head')--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/tonsky/FiraCode@1.206/distr/fira_code.css">--}}
{{--@endsection--}}

@section('content')
    <exercise :exercise='{!! $exercise->toJson() !!}' next-url="{{ $next_url }}" prev-url="{{ $prev_url }}"></exercise>
@endsection