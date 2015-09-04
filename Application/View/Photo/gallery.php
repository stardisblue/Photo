<div class="fullscreen_block hided">
    <ul class="optionset" data-option-key="filter">
        <li class="selected"><a href="#filter" data-option-value="*">All Works</a></li>
        <li><a data-option-value=".advertisement" href="#filter" title="View all post filed under advertisement">Advertisement</a></li>
        <li><a data-option-value=".cities" href="#filter" title="View all post filed under cities">Cities</a></li>
        <li><a data-option-value=".fashion" href="#filter" title="View all post filed under fashion">Fashion</a></li>
        <li><a data-option-value=".nature" href="#filter" title="View all post filed under nature">Nature</a></li>
        <li><a data-option-value=".portrait" href="#filter" title="View all post filed under portrait">Portrait</a></li>
        <li><a data-option-value=".stuff" href="#filter" title="View all post filed under stuff">Stuff</a></li>
    </ul>
    <div class="fs_blog_module image-grid">
        <?php foreach ($photos as $photo): ?>
            <div class="blogpost_preview_fw element tag">
                <div class="fw_preview_wrapper">
                    <div class="gallery_item_wrapper">
                        <a href="<?= WEB_ROOT ?>/photo/display/<?= $photo->photo_id ?>" >
                            <img src="<?= WEB_ROOT ?>/public/img/photo/gallery/<?= $photo->photo_name ?>" alt="" class="fw_featured_image" width="540">
                            <div class="gallery_fadder"></div>
                            <span class="gallery_ico"><i class="stand_icon icon-eye"></i></span>
                        </a>
                    </div>
                    <div class="grid-port-cont">
                        <h6><a href="<?= WEB_ROOT ?>/photo/display/<?= $photo->photo_id ?>"><?= $photo->photo_title ?></a></h6>
                        <div class="block_likes">
                            <div class="post-views"><i class="stand_icon icon-eye"></i> <span>7715</span></div>
                            <div class="gallery_likes gallery_likes_add already_liked">
                                <i class="stand_icon icon-heart"></i>
                                <span>129</span>
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
        <div class="copyright">Copyright &copy; 2014 Oyster HTML Template. All Rights Reserved.</div>
        <div class="socials_wrapper">
            <ul class="socials_list">
                <li><a class="ico_social_dribbble" target="_blank" href="http://dribbble.com/" title="Dribbble"></a></li>
                <li><a class="ico_social_gplus" target="_blank" href="https://plus.google.com/" title="Google+"></a></li>
                <li><a class="ico_social_vimeo" target="_blank" href="https://vimeo.com/" title="Vimeo"></a></li>
                <li><a class="ico_social_pinterest" target="_blank" href="http://pinterest.com" title="Pinterest"></a></li>
                <li><a class="ico_social_facebook" target="_blank" href="http://facebook.com" title="Facebook"></a></li>
                <li><a class="ico_social_twitter" target="_blank" href="http://twitter.com" title="Twitter"></a></li>
                <li><a class="ico_social_instagram" target="_blank" href="http://instagram.com" title="Instagram"></a></li>
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
    jQuery(document).ready(function($){
        "use strict";
        setTimeout(function(){
            jQuery('.fullscreen_block').removeClass('hided');
        },2500);
        setTimeout("jQuery('.preloader').remove()", 2700);
    });
</script>