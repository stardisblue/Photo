<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Photo ID</th>
            <th>Title</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($comments as $comment): ?>
            <tr>
                <td><?= $comment->photo_id ?></td>
                <td><?= $comment->comment_publication ?></td>
                <td><a href="<?= WEB_ROOT ?>/admin/comment/delete-<?= $comment->comment_id ?>">X</a></td>
                <td><a href="<?= WEB_ROOT ?>/admin/comment/update-<?= $comment->comment_id ?>">Update</a></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>