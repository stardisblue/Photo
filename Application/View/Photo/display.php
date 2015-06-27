<img src="<?= WEB_ROOT ?>/public/photo/<?= $photo->name ?>"/>

<form action="<?= WEB_ROOT ?>/comment/add/<?= $photo->id ?>" method="post">
    <label>Author</label>
    <input type="text" name="author"/>
    <label>Title</label>
    <input type="text" name="title"/>
    <label>Content</label>
    <textarea name="content"></textarea>
    <input type="submit" name="submit" value="Send"/>
</form>

<?php foreach ($comments as $comment): ?>
    <div class="comment">
        <p>Author : <?= $comment->author ?></p>
        <p>Publication : <?= $comment->publication ?></p>
        <h3><?= $comment->title ?></h3>
        <p><?= $comment->content ?></p>
    </div>
<?php endforeach ?>