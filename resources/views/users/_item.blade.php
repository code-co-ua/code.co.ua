<div class="col-md-7 row">
    <div class="col-sm-offset-2">
        <a href="{{ route('users.show', ['id' => $user->id]) }}">
            <img src="{{ $user->avatar_url }}"
                 alt="{{ $user->name }}">
        </a>
    </div>
    <div class="col-sm-7 ">
        <a href="{{ route('users.show', ['id' => $user->id]) }}">
            <h3>{{ $user->name }}</h3>
        </a>
        @if($user->about)
            <p class="m-0">{{ $user->about }}</p>
        @endif
    </div>
</div>