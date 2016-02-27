<div class="fw_content_wrapper">
    <div class="fw_content_padding">
        <div class="content_wrapper noTitle">
            <div class="container">
                <div class="content_block row no-sidebar">
                    <?php foreach ($tags as $tag): ?>
                        <p>
                            <?= $tag->tag_name ?>
                        </p>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="fixed_bg map_bg"></div>

<div class="content_bg"></div>
<script type="text/javascript" src="<?= WEB_ROOT ?>/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= WEB_ROOT ?>/js/modules.js"></script>
<script type="text/javascript" src="<?= WEB_ROOT ?>/js/theme.js"></script>
<script>
    jQuery(document).ready(function () {
        "use strict";
        centerWindow();
        if (window_w > 760) {
            jQuery('html').addClass('without_border');
        }
    });
    jQuery(window).load(function () {
        "use strict";
        centerWindow();
    });
    jQuery(window).resize(function () {
        "use strict";
        centerWindow();
        setTimeout('centerWindow()', 500);
        setTimeout('centerWindow()', 1000);
    });
    function centerWindow() {
        "use strict";
        var setTop = (window_h - jQuery('.fw_content_wrapper').height() - header.height()) / 2 + header.height();
        if (setTop < header.height() + 50) {
            jQuery('.fw_content_wrapper').addClass('fixed');
            jQuery('body').addClass('addPadding');
            jQuery('.fw_content_wrapper').css('top', header.height() + 50 + 'px');
        } else {
            jQuery('.fw_content_wrapper').css('top', setTop + 'px');
            jQuery('.fw_content_wrapper').removeClass('fixed');
            jQuery('body').removeClass('addPadding');
        }
    }
</script>