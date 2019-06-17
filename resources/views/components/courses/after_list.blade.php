@if($course->description_after)
    <hr>
    <div class="row">
        @parsedown($course->description_after)
    </div>
@endif