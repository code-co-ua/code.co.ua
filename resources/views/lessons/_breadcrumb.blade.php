<nav aria-label="breadcrumb">
    <ul class="breadcrumb">
        <li class="breadcrumb-item align-self-center">
            <a href="{{ route('home') }}">Мої курси</a>
        </li>
        <li class="breadcrumb-item align-self-center">
            <a href="{{ route('courses.show', ['course' => $lesson->section->course_id]) }}">
                {{ $course->name }}
            </a>
        </li>
        <li class="breadcrumb-item active align-self-center">
            {{--<a href="#">--}}{{ $lesson->section->title }}{{--</a>--}}
        </li>
        <li class="breadcrumb-item active align-self-center" aria-current="page">
            {{ $lesson->name }}
        </li>
        <li class="ml-auto">
            @include('lessons._controls')
        </li>
    </ul>
</nav>
