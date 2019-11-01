@if($course->last_competed_lesson_id)
    <a href="{{ route('lessons.show', [
        'course' => $course->id,
        'lesson' => $course->last_competed_lesson_id,
    ]) }}" class="btn btn-lg btn-block btn-outline-success text-uppercase mb-3">
        Продовжити
    </a>
@else
    <a href="{{ route('lessons.show', [
        'course' => $course->id,
        'lesson' => $course->first_lesson_id,
    ]) }}"
       class="btn btn-lg btn-block btn-primary text-uppercase mb-3">
        <span>Навчатись</span>
        <i class="material-icons">arrow_forward</i>
    </a>
@endif
