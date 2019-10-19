@if($course->last_competed_lesson_id)
    <a href="{{ route('lessons.show', ['id' => $course->last_competed_lesson_id]) }}"
       class="btn btn-lg btn-block btn-outline-success text-uppercase mb-3">Продовжити</a>
@else
    <a href="{{ route('lessons.show', ['id' => $course->first_lesson_id ]) }}"
       class="btn btn-lg btn-block btn-primary text-uppercase mb-3">
        <span>Навчатись</span>
        <i class="material-icons">arrow_forward</i>
    </a>
@endif