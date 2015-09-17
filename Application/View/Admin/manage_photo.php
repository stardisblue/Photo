<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($photos as $photo): ?>
                <tr>
                    <td><?= $photo->photo_title ?></td>
                    <td><a href="<?= WEB_ROOT ?>/admin-update-photo-<?= $photo->photo_id ?>">Update</a></td>
                    <td><a href="<?= WEB_ROOT ?>/admin-delete-photo-<?= $photo->photo_id ?>">X</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>