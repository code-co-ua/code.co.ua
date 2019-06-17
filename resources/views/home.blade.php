@extends('layouts.app')

@section('title', "Ваші курси")

@section('content')
    <div class="container">
        <h1 class="text-center">Ваші курси</h1>
        @forelse($courses as $course)
            @php
                $progress = (100 / $course->lessons_count) * $course->completed_lessons_count;
                $is_completed = $course->lessons_count !== $course->completed_lessons_count;
                $next_lesson_id = $course->last_completed_lesson_id ? $course->last_completed_lesson_id : $course->lessons[0]->id;
            @endphp
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="shadow-lg">
                        <img class="card-img-top" src="{{ asset($course->image) }}"
                             alt="{{ $course->image }}">
                        <h5 class="text-center card-footer">{{ $course->name }}</h5>
                    </div>
                </div>
                <div class="col-md-9 d-flex align-content-between flex-wrap shadow p-2 border-top border-info"
                     style="border-width: 4px !important;">
                    <div class="d-block w-100">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped {{ $is_completed ? 'progress-bar-animated' : 'bg-success' }}"
                                 role="progressbar"
                                 aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"
                                 style="width: {{ $progress }}%"></div>
                        </div>
                    </div>
                    <p>
                        {{ $course->description_short }}
                    </p>

                    <a href="{{ $is_completed ? route('lessons.show', ['id' => $next_lesson_id]) : route('courses.show', ['id' => $course->id]) }}"
                       class="btn btn-outline-info btn-block btn-lg">НАВЧАТИСЬ</a>
                </div>
            </div>
        @empty
            <h2 class="text-center">У вас немає курсів</h2>
            <a class="btn btn-primary btn-block btn-lg text-uppercase"
               href="{{ route('courses.index') }}">Знайти курси</a>
        @endforelse
    </div>
@endsection
