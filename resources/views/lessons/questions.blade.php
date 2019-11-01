@extends('layouts.app')

@section('title', $lesson->name . ' - Тести - ' . $course->name)

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
    <div class="container content">
        <div class="d-flex justify-content-center">
            <questions :questions='{{ $lesson->questions }}'
                       next-url="{{ route('lessons.show', ['id' => $next->id]) }}"></questions>
        </div>
        @include('components.comments', [
            'model' => $lesson
        ])
    </div>
@endsection