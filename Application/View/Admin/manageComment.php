<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Title</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($comments as $comment): ?>
            <tr>
                <td><?= $comment->title ?></td>
                <td>X</td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>