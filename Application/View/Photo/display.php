<div class="main_wrapper">
    <div class="content_wrapper">
        <div class="container simple-post-container">
            <div class="content_block no-sidebar row">
                <div class="fl-container ">
                    <div class="row">
                        <div class="posts-block simple-post">
                            <div class="contentarea">
                                <div class="row">
                                    <div class="span12 module_cont module_blog module_none_padding module_blog_page">
                                        <div class="blog_post_page sp_post">
                                            <div class="pf_output_container">
                                                <div class="slider-wrapper theme-default ">
                                                    <img src="<?= WEB_ROOT ?>/public/img/photo/<?= $photo->photo_name ?>" alt="<?= $photo->photo_title ?>"/>
                                                </div>
                                            </div>
                                            <div class="blogpreview_top">
                                                <div class="box_date">
                                                    <span class="box_month"><?= $photo->photo_month ?></span>
                                                    <span class="box_day"><?= $photo->photo_day ?></span>
                                                </div>
                                                <div class="listing_meta">
                                                    <span><?php foreach ($tags as $tag) { echo '#' . $tag->tag_name . ' '; } ?></span>
                                                    <span><a href="javascript:void(0)"><?= count($comments) === 1 ? '1 comment' : count($comments) . ' comments' ?></a></span>
                                                </div>
                                                <div class="author_ava"><img alt="" src="img/avatar/2.jpg" class="avatar" height="72" width="72" /></div>
                                            </div>
                                            <h3 class="blogpost_title"><?= $parser->parse($photo->photo_title) ?></h3>
                                        </div>

                                        <div class="blog_post_content">
                                            <article class="contentarea sp_contentarea">
                                                <div class="row">
                                                    <?= $parser->parse($photo->photo_description) ?>
                                                </div>
                                            </article>
                                        </div>

                                        <div class="blog_post-footer sp-blog_post-footer ">
                                            <div class="blogpost_share">
                                                <span>Share this:</span>
                                                <a href="javascript:void(0)" class="share_facebook"><i class="stand_icon icon-facebook-square"></i></a>
                                                <a href="javascript:void(0)" class="share_pinterest"><i class="stand_icon icon-pinterest"></i></a>                                                    <a href="javascript:void(0)" class="share_tweet"><i class="stand_icon icon-twitter"></i></a>
                                                <a href="javascript:void(0)" class="share_gplus"><i class="icon-google-plus-square"></i></a>
                                                <div class="clear"></div>
                                            </div>

                                            <div class="block_likes">
                                                <div class="post-views"><i class="stand_icon icon-eye"></i> <span><?= $photo->photo_visit ?></span></div>
                                                <div class="gallery_likes gallery_likes_add ">
                                                    <a href="#" id="ajax_like">
                                                        <i class="stand_icon icon-heart-o"></i>
                                                        <span><?= $photo->photo_like ?></span>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="single_hr">

                                <div class="row">
                                    <div class="span12">
                                        <div id="comments">
                                            <h4 class="headInModule postcomment"><?= count($comments) === 1 ? '1 Comment:' : count($comments) . ' Comments:' ?></h4>
                                            <ol class="commentlist">
                                                <?php foreach ($comments as $comment): ?>
                                                    <li class="comment odd alt thread-odd thread-alt depth-1">
                                                            <div class="thiscommentbody">
                                                                <div class="comment_info">
                                                                    <h6 class="author_name"><?= $comment->comment_author ?></h6>
                                                                    <h6 class="date"><?= $comment->comment_date ?></h6>
                                                                </div>
                                                                <p><?= $parser->parse($comment->comment_message) ?></p>
                                                            </div>
                                                            <div class="clear"></div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ol>

                                            <hr class="comment_hr">

                                            <div id="respond" class="comment-respond">
                                                <h3 id="reply-title" class="comment-reply-title">Leave a Comment!</h3>
                                                <form action="<?= WEB_ROOT ?>/comment/add/<?= $photo->photo_id ?>" method="post" id="commentform" class="comment-form">
                                                    <p class="comment-notes">Required fields are marked <span class="required">*</span></p>
                                                    <label class="label-name"></label><input type="text" placeholder="Name *" title="Name *" id="author" name="author" class="form_field">
                                                    <label class="label-message"></label><textarea name="message" cols="45" rows="5" placeholder="Message..." id="comment-message" class="form_field"></textarea>
                                                    <p class="form-allowed-tags">You may use these <abbr title="Markdown">Markdown</abbr> tags: <code>[This is an example inline link](yoururl.com) or **message** for strong front</code></p>
                                                    <p class="form-submit"><input name="submit" type="submit" id="submit" value="Post Comment" /></p>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="footer_wrapper container">
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
<script>
    jQuery(document).ready(function(){
        "use strict";
        jQuery('.commentlist').find('li').each(function(){
            if (jQuery(this).find('ul').size() > 0) {
                jQuery(this).addClass('has_ul');
            }
        });
        jQuery('.form-allowed-tags').width(jQuery('#commentform').width() - jQuery('.form-submit').width() - 13);

        jQuery('.pf_output_container').each(function(){
            if (jQuery(this).html() == '') {
                jQuery(this).parents('.blog_post_page').addClass('no_pf');
            } else {
                jQuery(this).parents('.blog_post_page').addClass('has_pf');
            }
        });

    });
    jQuery(window).resize(function(){
        "use strict";
        jQuery('.form-allowed-tags').width(jQuery('#commentform').width() - jQuery('.form-submit').width() - 13);
    });

    $('#ajax_like').click(function(event) {
        event.preventDefault();

        var url = '<?= WEB_ROOT ?>/photo/like/<?= $photo->photo_id ?>';

        $.ajax({
            url: url,
            method: 'POST',
            success: function(result) {
                if (result === 'BAN') {
                    alert('You already liked this photo');
                } else {
                    $('#ajax_like span').html(result);
                    alert('Thanks for liking :)');
                }
            }
        });
    });
</script>