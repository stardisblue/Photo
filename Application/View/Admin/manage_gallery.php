<div class="table-responsive">
    <form action="<?= WEB_ROOT ?>/admin/gallery/add" method="post">
        <select name="photo">
            <?php foreach ($select as $photo): ?>
                <option value="<?= $photo->photo_id ?>"><?= $photo->photo_title ?></option>
            <?php endforeach ?>
        </select>
        <input type="submit" value="Add">
    </form>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Title</th>
            <th>Remove</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($photos as $photo): ?>
            <tr>
                <td><?= $photo->photo_title ?></td>
                <td><a href="<?= WEB_ROOT ?>/admin/gallery/delete-<?= $photo->photo_id ?>">X</a></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>