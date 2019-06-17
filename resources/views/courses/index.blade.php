@extends('layouts.app')

@section('title', __('Доступні курси'))

@section('content')
    <div class="container">
        <h1 class="text-center">
            {{ __('Доступні курси') }}
        </h1>
        <div class="card-columns">
            @foreach($courses as $course)
                <div class="card">
                    <img class="card-img-top" src="{{ asset($course->image) }}" alt="{{ $course->image }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $course->name }}</h5>
                        <p class="card-text">{{ $course->description_short }}</p>
                        <a href="{{ route('courses.show', ['id' => $course->id]) }}"
                           class="btn btn-primary btn-block">{{ __('НАВЧАТИСЬ') }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection