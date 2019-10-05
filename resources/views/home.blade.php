@extends('layouts.app')

@section('title', "Ваші курси")

@section('main-class', 'container')

@section('content')
    <h1 class="page-title">Ваші курси</h1>
    @if($courses)
    <div class="table-responsive">
        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
            <thead>
            <tr>
                <th class="text-center w-1"><i class="icon-people"></i></th>
                <th>Назва</th>
                <th>Прогрес</th>
{{--                <th>Активність</th>--}}
                <th>Дії</th>
            </tr>
            </thead>
            <tbody>

            @foreach($courses as $course)
                <tr>
                    <td class="bg-contain bg-center bg-no-repeat td-image" style="background: url({{ $course->image }});"></td>
                    <td>
                        <a href="{{ route('courses.show', ['course' => $course->id]) }}">
                            {{ $course->title }}
                        </a>
                    </td>
                    <td>
                        <div class="clearfix">
                            <div class="float-left">
                                <strong>{{ $course->progress }}%</strong>
                            </div>
                            <div class="float-right">
                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                            </div>
                        </div>
                        <div class="progress progress-xs">
                            <div class="progress-bar {{ $course->progress == 100 ? 'bg-success' : 'bg-azure' }}"
                                 role="progressbar"
                                 style="width: {{ $course->progress }}%"
                                 aria-valuenow="{{ $course->progress }}"
                                 aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                    </td>
                    {{-- TODO - last lesson completed at <td>
                        <div class="small text-muted">Останній урок пройдено</div>
                        <div>8 minutes ago</div>
                    </td>--}}
                    <td>
                        <a href="{{ route('lessons.show', ['id' => $course->last_completed_lesson_id
                                                                    ?? $course->first_lesson_id]) }}"
                           class="btn btn-success">
                            Продовжити
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <h2 class="text-center">У вас немає курсів</h2>
        <a class="btn btn-primary btn-block btn-lg text-uppercase" href="{{ route('courses.index') }}">Знайти курси</a>
    @endif
@endsection
