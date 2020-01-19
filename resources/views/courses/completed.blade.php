@extends('layouts.app')

@section('title', $course->lessons_count == $course->completed_lessons_count ? 'КУРС ПРОЙДЕНО!' . ' - ' . $course->name : 'Упс...')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="jumbotron text-center">
                    @if($course->lessons_count == $course->completed_lessons_count)
                        <h1 class="display-4">{{ $course->name }}</h1>
                        <p class="lead">Вітаю! Ви успішно пройшли курс.</p>
                        <hr class="my-4">
                        <p>Тепер він в профілі, серед списку пройдених курсів <img
                                    src="{{ asset('img/smile-cool.png') }}" alt="cool smile" width="30px"></p>
                        <a class="btn btn-primary btn-lg text-uppercase" href="{{ route('users.show', ['id' => auth()->id()]) }}" role="button">Сторінка профілю</a>
                    @else
                        <h1>Упс...</h1>
                        <h3>Спочатку вам потрібно пройти курс</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
