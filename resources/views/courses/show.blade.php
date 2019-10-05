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
            @include('components.courses.completed_alert')
        @endif

        <h1 class="page-heading">{{ $course->title }}</h1>

        <div class="d-md-none d-lg-none">
            @include('components.courses.button')
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="mb-2">
                    @parsedown($course->description)
                </div>
                <h2>Зміст</h2>
                @include('components.courses.list')
                @include('components.courses.after_list')
            </div>

            <div class="col-md-4">
                @include('components.courses.information')
            </div>

            <div class="col-md-12 mt-4">
                @include('components.comments', [
                    'model' => $course
                ])
            </div>
        </div>
    </div>
@endsection