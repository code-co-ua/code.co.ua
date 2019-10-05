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
                <a href="{{ route('courses.show', ['course' => $course->id]) }}" class="text-decoration-none text-reset">
                    <div class="card d-flex flex-row bg-white shadow-none p-3">
                        <img src="{{ $course->image }}" alt="{{ $course->name }}">
                        <div class="card-body p-0 pl-3">
                            <h4 class="mb-0">
                                {{ $course->title }}
                            </h4>
                            <div class="text-muted">{{ $course->description_short }}</div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection