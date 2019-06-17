<div class="col-md-12 mt-4 p-0">
    <div class="card w-100 bg-light mb-3">
        <div class="card-header">
            Теги
        </div>
        <div class="card-body">
            @foreach($tags as $tag)
                <a href="{{-- TODO - show articles by tags --}}" class="text-info">
                    #{{ strtoupper($tag->name) }}[{{ $tag->count }}]
                </a>
            @endforeach
        </div>
    </div>
</div>