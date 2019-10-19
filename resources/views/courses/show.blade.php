@extends('layouts.app')

@section('title', $course->title)

@section('head')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        li {
            list-style-type: none;
        }

        .material-icons {
            vertical-align: middle;
        }


        .information li {
            font-size: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        @if($course->isCompleted())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Примітка: </strong> ви завершили даний курс.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <h1 class="page-heading">{{ $course->title }}</h1>

        <div class="d-md-none d-lg-none">
            @include('courses._button')
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="mb-2">
                    @parsedown($course->description)
                </div>
                <h2>Зміст</h2>
                @include('courses._list')
                @if($course->description_after)
                    <hr>
                    <div class="row">
                        @parsedown($course->description_after)
                    </div>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card mb-3">
                    <img class="card-img-top" src="{{ asset($course->image) }}" alt="{{ $course->name }}">
                    <div class="card-body">
                        @include('courses._button')
                        <ul class="pl-2 mb-0 information list-style-type-none">
                            <li>
                                <i class="material-icons">attach_money</i> Безкоштовно!
                            </li>
                            <li class="text-success">
                                <i class="material-icons">flash_on</i> Постійно оновлюється
                            </li>
                            <li>
                                <i class="material-icons">book</i> {{ $course->lessons_count }}
                                {{ trans_choice('messages.lessons', $course->lessons_count) }}
                            </li>
                            <li>
                                <i class="material-icons">code</i> {{ $course->exercises_count }}
                                {{ trans_choice('messages.exercises', $course->exercises_count) }}
                            </li>
                            <li>
                                <i class="material-icons">question_answer</i> {{ $course->questions_count }}
                                {{ trans_choice('messages.questions', $course->questions_count) }}
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-4">
                @include('components.comments', [
                    'model' => $course
                ])
            </div>
        </div>
    </div>
@endsection