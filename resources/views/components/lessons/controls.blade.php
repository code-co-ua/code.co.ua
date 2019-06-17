<div class="btn-group {{ !isset($normal_controls) ? 'btn-group-lg ' : '' }} w-100 mx-auto">
    @if($previous)
        <a href="{{ route('lessons.show', ['id' => $previous->id]) }}"
           class="btn btn-outline-secondary">&larr; Попереднє</a>
    @endif

    @if($lesson->exercises_count > 0)
        <a href="{{ route('lessons.exercise', ['id' => $lesson->id]) }}"
           class="btn btn-outline-primary">Вправи &rarr;</a>
    @elseif($lesson->questions_count > 0 && !Route::is('lessons.questions'))
        <a href="{{ route('lessons.questions', ['id' => $lesson->id]) }}"
           class="btn btn-outline-primary">Тести &rarr;</a>
    @elseif($next)
        <a href="{{ route('lessons.show', ['id' => $next->id]) }}"
           class="btn btn-outline-info">Наступне &rarr;</a>
    @else
        <a href="{{ route('courses.complete', ['id' => $lesson->section->course_id ]) }}"
           class="btn btn-success">ЗАВЕРШИТИ!</a>
    @endif
</div>