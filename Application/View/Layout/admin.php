<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8"/>
        <title>Administration zone</title>
        <link href="<?= WEB_ROOT ?>/css/admin/admin.css" rel="stylesheet" type="text/css"/>
        <link href="<?= WEB_ROOT ?>/css/admin/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?= WEB_ROOT ?>/js/jquery.min.js" type="text/javascript" rel="script"></script>
    </head>

    <body>
        <div class="container">
            <div class="header clearfix">
                <?php if ($loggedIn === true): ?>
                    <nav>
                        <ul class="nav nav-pills pull-right">
                            <li role="presentation" <?= isset($manage) ? 'class="active"' : null ?>><a href="<?= WEB_ROOT ?>/admin-manage">Manage</a></li>
                            <li role="presentation"><a href="<?= WEB_ROOT ?>/">Home</a></li>
                            <li role="presentation"><a href="<?= WEB_ROOT ?>/logout">Logout</a></li>
                        </ul>
                    </nav>
                <?php endif; ?>
                <h3 class="text-muted">Administration zone</h3>
            </div>

            <?= $content ?>
        </div>
    </body>
</html>