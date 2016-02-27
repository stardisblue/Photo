<div>
    <a href="<?=WEB_ROOT?>/admin/photo/add" class="btn btn-success"><i class="glyphicon-plus"></i> Add photo</a>
</div>

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
                <td><a href="<?= WEB_ROOT ?>/admin/photo/update-<?= $photo->photo_id ?>">Update</a></td>
                <td><a href="<?= WEB_ROOT ?>/admin/photo/delete-<?= $photo->photo_id ?>">X</a></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>