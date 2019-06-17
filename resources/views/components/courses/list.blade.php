<div class="list-group">
    <div class="row list-group">
        @foreach ($course->sections as $section)
            <a class="list-group-item" data-toggle="collapse" href="#section{{ $loop->iteration }}"
               role="button" aria-expanded="false" aria-controls="section{{ $loop->iteration }}">
                <i class="material-icons">keyboard_arrow_down</i>
                {{ $loop->iteration }}. {{ $section->title }}
            </a>
            <div class="collapse text-lg" id="section{{ $loop->iteration }}">
                <ul>
                    @foreach($section->lessons as $lesson)
                        <li>
                            <span class="text-black-50">{{ $loop->iteration }}: </span>
                            <a href="{{ route('lessons.show', ['id' => $lesson->id]) }}">{{ $lesson->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>