<div class="btn-group {{ !isset($normal_controls) ? 'btn-group-lg ' : '' }} w-100 mx-auto">
    @if($previous)
        <a href="{{ route('lessons.show', ['id' => $previous->id]) }}"
           class="btn btn-secondary">&larr; Попереднє</a>
    @endif

    @if($lesson->exercises_count > 0)
        <a href="{{ route('lessons.exercise', ['id' => $lesson->id]) }}"
           class="btn btn-primary">Вправи &rarr;</a>
    @elseif($lesson->questions_count > 0 && !Route::is('lessons.questions'))
        <a href="{{ route('lessons.questions', ['id' => $lesson->id]) }}"
           class="btn btn-primary">Тести &rarr;</a>
    @elseif($next)
        <a href="{{ route('lessons.show', ['id' => $next->id]) }}"
           class="btn btn-secondary">Наступне &rarr;</a>
    @else
        <a href="{{ route('courses.complete', ['id' => $lesson->section->course_id ]) }}"
           class="btn btn-success">Завершити &rarr;</a>
    @endif
</div>