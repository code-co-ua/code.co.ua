
@extends('layouts.app')

@section('title', $lesson->name . ' - ' . $lesson->section->course->name)

@section('head')
    <meta name="description" content="{{ $lesson->section->course->description }}">
    <meta property="og:title" content="{{ $lesson->name . ' - ' . $lesson->section->course->name }}">
    <meta property="og:description" content="{{ $lesson->section->course->description }}">
    @if($lesson->video)
        <meta property="og:type" content="video.episode">
        <meta property="og:video" content='https://www.youtube.com/watch?v={{ $lesson->video }}'>
        <meta property="og:image" content="https://img.youtube.com/vi/{{ $lesson->video }}/hqdefault.jpg">
    @endif
    @if($lesson->updated_at)
        <meta property="og:updated_time" content="{{ $lesson->updated_at }}">
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <article class="col-lg-12 content">
                @include('components.lessons.breadcrumb')
                @include('components.lessons.content')
                @include('components.lessons.controls')
                @include('components.comments', [
                    'model' => $lesson
                ])
            </article>
        </div>
    </div>
@endsection