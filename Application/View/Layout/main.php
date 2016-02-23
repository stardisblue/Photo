<!DOCTYPE html>
<html class="fullscreen_page sticky_menu">
<head>
    <title>Pascual Photography</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="<?= WEB_ROOT ?>/img/favico.ico" type="image/x-icon">
    <link href="http://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,300,500,900" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= WEB_ROOT ?>/css/theme.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="<?= WEB_ROOT ?>/css/responsive.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="<?= WEB_ROOT ?>/css/custom.css" type="text/css" media="all"/>
    <script type="text/javascript" src="<?= WEB_ROOT ?>/js/jquery.min.js"></script>
</head>
<body>
<header class="main_header">
    <div class="header_wrapper">
        <div class="logo_sect">
            <a href="<?= WEB_ROOT ?>/" class="logo"><img src="<?= WEB_ROOT ?>/img/logo.png" alt="" class="logo_def"><img
                    src="/img/retina/logo.png" alt="" class="logo_retina"></a>
            <div class="slogan">Florian Pascual Photography</div>
        </div>
        <div class="header_rp">
            <nav>
                <div class="menu-main-menu-container">
                    <ul id="menu-main-menu" class="menu">
                        <li class="menu-item-has-children">
                            <a href="<?= WEB_ROOT ?>/"><span><?= $i18n->headerHome ?></span></a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="<?= WEB_ROOT ?>/photo"><span><?= $i18n->headerGallery ?></span></a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="<?= WEB_ROOT ?>/contact"><span><?= $i18n->headerContact ?></span></a>
                        </li>
                    </ul>
                </div>
                <div class="search_fadder"></div>
                <div class="header_search">
                    <form name="search_form" method="post" action="<?= WEB_ROOT ?>/search" class="search_form">
                        <input type="text" name="search" placeholder="<?= $i18n->headerSearch ?>..."
                               class="field_search">
                    </form>
                </div>
            </nav>
            <a class="search_toggler" href="#"></a>
        </div>
        <div class="clear"></div>
    </div>
</header>

<?= $content ?>

</body>
</html>