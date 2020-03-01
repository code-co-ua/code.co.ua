<div class="btn-group {{ !isset($normal_controls) ? 'btn-group-lg ' : '' }} w-100 mx-auto">
    @if($previous)
        <a href="{{ route('lessons.show', ['id' => $previous->id]) }}" class="btn btn-secondary">&larr; Попереднє</a>
    @endif

    @if($lesson->exercise_count > 0)
        <a href="{{ route('lessons.exercise', ['course' => $course->id, 'lesson' => $lesson->id]) }}"
           class="btn btn-primary">Практика &rarr;</a>
    @elseif(Auth::check() && $lesson->questions_count > 0 && !Route::is('lessons.questions'))
        <a href="{{ route('lessons.questions', ['course' => $course->id, 'lesson' => $lesson->id]) }}"
           class="btn btn-primary">Тести &rarr;</a>
    @elseif($next)
        <a href="{{ route('lessons.show', ['id' => $next->id]) }}" class="btn btn-secondary">Наступне &rarr;</a>
    @else
        <a href="{{ route('courses.complete', ['course' => $course->id ]) }}" class="btn btn-success">
            Завершити &rarr;
        </a>
    @endif
</div>
