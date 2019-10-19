@if($lesson->video)
    <iframe width="100%" height="315" style="/*width: 762px;*/height: 428.625px;"
            src="https://www.youtube.com/embed/{{ $lesson->video }}?rel=0&amp;showinfo=0;autoplay=1"
            frameborder="0"
            allow="autoplay; encrypted-media" allowfullscreen></iframe>
@endif

@if($lesson->body)
    @parsedown($lesson->body)
@endif
