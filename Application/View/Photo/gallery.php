<div class="fullscreen_block hided">
    <ul class="optionset" data-option-key="filter">
        <li class="selected"><a href="#filter" data-option-value="*">All Works</a></li>
        <?php foreach ($popularTags as $tag): ?>
            <li><a data-option-value=".<?= $tag->tag_name ?>" href="#filter" title="View all post filed under <?= $tag->tag_name ?>"><?= ucfirst($tag->tag_name) ?></a></li>
        <?php endforeach; ?>
    </ul>
    <div class="fs_blog_module image-grid">
        <?php foreach ($photos as $photo): ?>
            <div class="blogpost_preview_fw element<?php foreach ($tags[$photo->photo_id] as $tag) { echo ' ' . $tag->tag_name; } ?>">
                <div class="fw_preview_wrapper">
                    <div class="gallery_item_wrapper">
                        <a href="<?= WEB_ROOT ?>/photo-display-<?= $photo->photo_id ?>" >
                            <img src="<?= WEB_ROOT ?>/public/img/photo/gallery/<?= $photo->photo_name ?>" alt="" class="fw_featured_image" width="540">
                            <div class="gallery_fadder"></div>
                            <span class="gallery_ico"><i class="stand_icon icon-eye"></i></span>
                        </a>
                    </div>
                    <div class="grid-port-cont">
                        <h6><a href="<?= WEB_ROOT ?>/photo-display-<?= $photo->photo_id ?>"><?= $photo->photo_title ?></a></h6>
                        <div class="block_likes">
                            <div class="post-views"><i class="stand_icon icon-eye"></i> <span><?= $photo->photo_visit ?></span></div>
                            <div class="gallery_likes gallery_likes_add already_liked">
                                <a id="ajax_like<?= $photo->photo_id ?>" onclick="ajaxLike(<?= $photo->photo_id ?>)">
                                    <i class="stand_icon icon-heart"></i>
                                    <span><?= $photo->photo_like ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="preloader"></div>

<footer class="fullwidth">
    <div class="footer_wrapper">
        <div class="copyright">Copyright &copy; KaiserCoder. Made with Oyster HTML Template. All Rights Reserved.</div>
        <div class="socials_wrapper">
            <ul class="socials_list">
                <li><a class="ico_social_gplus" target="_blank" href="https://plus.google.com/" title="Google+"></a></li>
                <li><a class="ico_social_facebook" target="_blank" href="http://facebook.com" title="Facebook"></a></li>
                <li><a class="ico_social_500px" target="_blank" href="http://500px.com" title="500px"></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</footer>

<div class="content_bg"></div>
<script type="text/javascript" src="<?= WEB_ROOT ?>/public/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= WEB_ROOT ?>/public/js/modules.js"></script>
<script type="text/javascript" src="<?= WEB_ROOT ?>/public/js/theme.js"></script>
<script type="text/javascript" src="<?= WEB_ROOT ?>/public/js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="<?= WEB_ROOT ?>/public/js/sorting.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        "use strict";
        setTimeout(function(){
            $('.fullscreen_block').removeClass('hided');
        }, 2500);
        setTimeout("$('.preloader').remove()", 2700);
    });

    var ajaxLike = function(id) {
        var url = '<?= WEB_ROOT ?>/photo-like-' + id;

        $.ajax({
            url: url,
            method: 'POST',
            success: function(result) {
                if (result === 'BAN') {
                    alert('You already liked this photo');
                } else {
                    $('#ajax_like' + id + ' span').html(result);
                    alert('Thanks for liking :)');
                }
            }
        });
    };
</script>