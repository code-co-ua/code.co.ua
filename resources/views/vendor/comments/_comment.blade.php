@if(isset($reply) && $reply === true)
  <div id="comment-{{ $comment->id }}" class="media">
@else
  <li id="comment-{{ $comment->id }}" class="media">
@endif

    {{-- Remove duplicated query to db - check if it auth user --}}
    @php($commenter = $comment->commenter_id == auth::id() ? auth()->user() : $comment->commenter)

    <img class="mr-3" src="{{ Cloudder::show($commenter->avatar, ['width' => 150, 'height' => 150]) }}" alt="{{ $commenter->name }} Avatar" width="64px">
    <div class="media-body">
        <h5 class="mt-0 mb-1">{{ $commenter->name }} <small class="text-muted">- {{ $comment->created_at->diffForHumans() }}</small></h5>
        <div style="white-space: pre-wrap;">@parsedown($comment->comment)</div>

        <p>
            @can('reply-to-comment', $comment)
                <button data-toggle="modal" data-target="#reply-modal-{{ $comment->id }}" class="btn btn-sm btn-link text-uppercase">Відповісти</button>
            @endcan
            @can('edit-comment', $comment)
                <button data-toggle="modal" data-target="#comment-modal-{{ $comment->id }}" class="btn btn-sm btn-link text-uppercase">Редагувати</button>
            @endcan
            @can('delete-comment', $comment)
                <a href="{{ url('comments/' . $comment->id) }}" onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->id }}').submit();" class="btn btn-sm btn-link text-danger text-uppercase">Видалити</a>
                <form id="comment-delete-form-{{ $comment->id }}" action="{{ url('comments/' . $comment->id) }}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>
            @endcan
        </p>

        @can('edit-comment', $comment)
            <div class="modal fade" id="comment-modal-{{ $comment->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ url('comments/' . $comment->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Редагувати коментар</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <textarea required class="form-control" name="message" rows="6">{{ $comment->comment }}</textarea>
                                    <small class="form-text text-muted"><a target="_blank" href="https://help.github.com/articles/basic-writing-and-formatting-syntax">Markdown</a> використовується.</small>
                                </div>
                            </div>
                            <div class="modal-footer w-100 btn-group">
                                <button type="button" class="btn w-100 btn-outline-secondary text-uppercase" data-dismiss="modal">Скасувати</button>
                                <button type="submit" class="btn w-100 btn-outline-success text-uppercase">Оновити</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        @can('reply-to-comment', $comment)
            <div class="modal fade" id="reply-modal-{{ $comment->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ url('comments/' . $comment->id) }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Відповісти на коментар</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <textarea required class="form-control" name="message" rows="6"></textarea>
                                    <small class="form-text text-muted"><a target="_blank" href="https://help.github.com/articles/basic-writing-and-formatting-syntax">Markdown</a> використовується.</small>
                                </div>
                            </div>
                            <div class="modal-footer btn-group w-100">
                                <button type="button" class="btn btn-outline-secondary text-uppercase w-100" data-dismiss="modal">Скасувати</button>
                                <button type="submit" class="btn btn-outline-success text-uppercase w-100">Відповісти</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        <br>{{-- Margin bottom --}}

        @foreach($comment->children as $child)
            @include('comments::_comment', [
                'comment' => $child,
                'reply' => true
            ])
        @endforeach
    </div>
@if(isset($reply) && $reply === true)
  </div>
@else
  </li>
@endif
