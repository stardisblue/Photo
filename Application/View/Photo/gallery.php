<?php foreach ($photos as $photo): ?>
    <a href="<?= WEB_ROOT ?>/photo/display/<?= $photo->id ?>"><img src="<?= WEB_ROOT . '/public/photo/' . $photo->name ?>"/></a>
<?php endforeach ?>