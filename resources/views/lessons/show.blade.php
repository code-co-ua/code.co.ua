@extends('layouts.app')

@section('title', $lesson->name . ' - ' . $course->name)

@section('main-class', 'container')

@section('head')
    <meta name="description" content="{{ $course->description }}">
    <meta property="og:title" content="{{ $lesson->name . ' - ' . $course->name }}">
    <meta property="og:description" content="{{ $course->description }}">
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
    <article class="content">
        @include('lessons._breadcrumb')
        @include('lessons._content')
        @include('lessons._controls')
        @include('components.comments', [
            'model' => $lesson
        ])
    </article>
@endsection
