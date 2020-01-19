<form method="POST" action="{{ url('comments') }}">
    @csrf
    <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}"/>
    <input type="hidden" name="commentable_id" value="{{ $model->id }}"/>
    <div class="form-group">
        <label for="message">Ваш коментар:</label>
        <text-editor name="message"></text-editor>
        <div class="invalid-feedback">
            Текст повідомлення обов'язковий.
        </div>
    </div>
    <button type="submit" class="btn btn-lg btn-outline-success text-uppercase btn-block">Додати</button>
</form>
<br>
