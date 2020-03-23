<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#postModal">
    Добавить запись
</button>

<!-- Modal -->
<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="post-modal-form" action="{{ route('posts.store') }}" method="post">
                @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить запись</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input name="title" type="text" class="form-control" id="title" aria-describedby="title" required>
                    </div>

                    <div class="form-group">
                        <label for="text">Текст</label>
                        <textarea name="text" class="form-control" id="text" rows="3" required></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
            </form>

        </div>
    </div>
</div>
