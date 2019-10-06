@extends('layouts.app')

@section('title', __('Доступні курси'))

@section('main-class', 'container')

@section('content')
    <h1 class="page-title mb-1">
        {{ __('Доступні курси') }}:
    </h1>
    <div class="row row-cards row-deck">
        @foreach($courses as $course)
            <div class="col-lg-4">
                @include('courses._item', [
                    'course' => $course,
                    'route' => route('courses.show', ['course' => $course->id])
                ])
            </div>
        @endforeach

        {{-- TODO: Because there is no way to say "Google, dont index these test content",
                    we need to use custom keywords in text generations--}}
        @foreach($fake_courses as $course)
            <div class="col-lg-4">
                @include('courses._item', [
                    'course' => $course,
                    'route' => '#',
                    'blur' => true
                ])
            </div>
        @endforeach
    </div>
@endsection