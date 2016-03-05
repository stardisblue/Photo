<form action="<?= WEB_ROOT ?>/admin/comment/update-<?= $comment->comment_id ?>" method="post">
    <div class="form-group">
        <label>Author</label>
        <input class="form-control" type="text" name="author" value="<?= $comment->comment_author ?>"/>
    </div>
    <div class="form-group">
        <label>Message</label>
        <textarea class="form-control" name="message"><?= $comment->comment_message ?></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-default" type="submit" name="submit" value="Update"/>
    </div>
</form>