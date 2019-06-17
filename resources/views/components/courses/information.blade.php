<div class="card mb-3">
    <img class="card-img-top" src="{{ asset($course->image) }}" alt="{{ $course->name }}">
    <div class="card-body">
        {{--<h2>Про курс</h2>--}}
        <ul class="pl-2 mb-0 information list-style-type-none">
            <li>
                <i class="material-icons">attach_money</i> Безкоштовно!
            </li>
            <li class="text-success">
                <i class="material-icons">flash_on</i> Постійно оновлюється
            </li>
            <li>
                <i class="material-icons">book</i> {{ $course->lessons_count }}
                {{ trans_choice('messages.lessons', $course->lessons_count) }}
            </li>
            <li>
                <i class="material-icons">code</i> {{ $course->exercises_count }}
                {{ trans_choice('messages.exercises', $course->exercises_count) }}
            </li>
            <li>
                <i class="material-icons">question_answer</i> {{ $course->questions_count }}
                {{ trans_choice('messages.questions', $course->questions_count) }}
            </li>

        </ul>
    </div>
</div>