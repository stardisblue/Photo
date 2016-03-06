<div class="fs_fadder hided"></div>
<div class="fs_sharing_wrapper hided">
    <div class="fs_sharing">
        <a href="http://www.facebook.com/share.php?u=http://www.gt3themes.com/website-templates/oyster/"
           class="share_facebook" target="_blank"><i class="icon-facebook-square"></i></a>
        <a href="http://pinterest.com/pin/create/button/?url=http://www.gt3themes.com/website-templates/oyster/&media=http://www.gt3themes.com/website-templates/oyster/img/logo.png"
           class="share_pinterest" target="_blank"><i class="icon-pinterest"></i></a>
        <a href="https://twitter.com/intent/tweet?text=Fullscreen Slider&url=http://www.gt3themes.com/website-templates/oyster/"
           class="share_tweet" target="_blank"><i class="icon-twitter"></i></a>
        <a href="https://plus.google.com/share?url=http://www.gt3themes.com/website-templates/oyster/"
           class="share_gplus" target="_blank"><i class="icon-google-plus-square"></i></a>
        <a class="fs_share_close hided" href="javascript:void(0)"></a>
    </div>
</div>
<div class="content_bg"></div>
<script type="text/javascript" src="<?= WEB_ROOT ?>/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= WEB_ROOT ?>/js/modules.js"></script>
<script type="text/javascript" src="<?= WEB_ROOT ?>/js/theme.js"></script>
<script>
    gallery_set = [
        <?php foreach ($photos as $photo): ?>
        {
            image: "<?= WEB_ROOT ?>/img/photo/<?= $photo->photo_name ?>",
            thmb: "<?= WEB_ROOT ?>/img/photo/gallery/<?= $photo->photo_name ?>",
            alt: "<?= $photo->photo_title ?>",
            title: "<?= $photo->photo_title ?>",
            description: "<?= $photo->photo_subtitle ?>",
            titleColor: "#ffffff",
            descriptionColor: "#ffffff"
        },
        <?php endforeach; ?>
    ];

    jQuery(document).ready(function () {
        "use strict";
        jQuery('html').addClass('hasPag');
        jQuery('body').fs_gallery({
            fx: 'fade', /*fade, zoom, slide_left, slide_right, slide_top, slide_bottom*/
            fit: 'fit_always',
            slide_time: 3300, /*This time must be < then time in css*/
            autoplay: 1,
            show_controls: 1,
            slides: gallery_set
        });
        jQuery('.fs_share').click(function () {
            jQuery('.fs_fadder').removeClass('hided');
            jQuery('.fs_sharing_wrapper').removeClass('hided');
            jQuery('.fs_share_close').removeClass('hided');
        });
        jQuery('.fs_share_close').click(function () {
            jQuery('.fs_fadder').addClass('hided');
            jQuery('.fs_sharing_wrapper').addClass('hided');
            jQuery('.fs_share_close').addClass('hided');
        });
        jQuery('.fs_fadder').click(function () {
            jQuery('.fs_fadder').addClass('hided');
            jQuery('.fs_sharing_wrapper').addClass('hided');
            jQuery('.fs_share_close').addClass('hided');
        });

        jQuery('.close_controls').click(function () {
            if (jQuery(this).hasClass('open_controls')) {
                jQuery('.fs_controls').removeClass('hide_me');
                jQuery('.fs_title_wrapper ').removeClass('hide_me');
                jQuery('.fs_thmb_viewport').removeClass('hide_me');
                jQuery('header.main_header').removeClass('hide_me');
                jQuery(this).removeClass('open_controls');
            } else {
                jQuery('header.main_header').addClass('hide_me');
                jQuery('.fs_controls').addClass('hide_me');
                jQuery('.fs_title_wrapper ').addClass('hide_me');
                jQuery('.fs_thmb_viewport').addClass('hide_me');
                jQuery(this).addClass('open_controls');
            }
        });

        jQuery('.main_header').removeClass('hided');
        jQuery('html').addClass('without_border');

        $('body').attr('style', 'background: #000 !important');
    });
</script>
<script type="text/javascript" src="<?= WEB_ROOT ?>/js/fs_gallery.js"></script>