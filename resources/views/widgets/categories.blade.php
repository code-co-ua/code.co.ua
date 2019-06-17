<a href="{{ route('articles.create') }}" class="btn btn-block shadow" id="addButton">+ Додати статтю</a>
<ul class="nav nav-pills pt-2 flex-column">
    <li>
        <a href="{{ route('articles.index') }}" class="text-info">
            <div class="articles-box" style="background-color: #000;"></div>
            Всі
        </a>
    </li>
    @foreach($categories as $category)
        <li>
            <a href="{{-- TODO - add filter by categories --}}" style="color: {{ $category->color }}">
                <div class="articles-box" style="background-color: {{ $category->color }}"></div>
                {{ $category->name }}
            </a>
        </li>
    @endforeach
</ul>
