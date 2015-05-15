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
                    <td><?= $photo->title ?></td>
                    <td>Update</td>
                    <td>X</td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>