<a href="{{ $route }}" class="text-decoration-none text-reset">
    <div class="card {{ isset($blur) ? 'blur' : '' }} d-flex flex-row bg-white shadow-none p-3">
        <img class="img-sm" src="{{ $course->image }}" alt="{{ $course->title }}">
        <div class="card-body p-0 pl-3">
            <h4 class="mb-0">
                {{ $course->title }}
            </h4>
            <div class="text-muted">{{ $course->description_short }}</div>
        </div>
    </div>
</a>