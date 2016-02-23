<div class="fw_content_wrapper">
    <div class="fw_content_padding">
        <div class="content_wrapper noTitle">
            <div class="container">
                <div class="content_block row no-sidebar">
                    <div class="fl-container ">
                        <div class="row">
                            <div class="posts-block ">
                                <div class="contentarea">
                                    <div class="row">
                                        <div class="span8 first-module module_number_1 module_cont pb0 module_html">
                                            <div class="bg_title"><h4
                                                    class="headInModule"><?= $i18n->contactTouch ?></h4></div>
                                            <div class="module_content contact_form">
                                                <div id="note"></div>
                                                <div id="fields">
                                                    <form id="ajax-contact-form" action="#">
                                                        <div class="w50 pr7"><input type="text" name="name" value=""
                                                                                    placeholder="<?= $i18n->contactName ?>"/>
                                                        </div>
                                                        <div class="w50"><input type="text" name="email" value=""
                                                                                placeholder="<?= $i18n->contactEmail ?>"/>
                                                        </div>
                                                        <div class="clear"></div>
                                                        <input type="text" name="subject" value=""
                                                               placeholder="<?= $i18n->contactSubject ?>"/>
                                                        <textarea name="message" id="message"
                                                                  placeholder="<?= $i18n->contactMessage ?>"></textarea>
                                                        <input type="submit" value="<?= $i18n->contactSend ?>">
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!-- .module_cont -->
                                        <div class="span4 module_number_2 module_cont no_bg pb0 module_contact_info">
                                            <div class="bg_title"><h4
                                                    class="headInModule"><?= $i18n->contactInformation ?></h4></div>
                                            <ul class="contact_info_list contact_icons">
                                                <li class="contact_info_item">
                                                    <div class="contact_info_wrapper">
                                                        <span class="contact_info_icon"><i class="icon-home"></i></span>
                                                        <div class="contact_info_text">Montpellier / France</div>
                                                    </div>
                                                </li>
                                                <li class="contact_info_item">
                                                    <div class="contact_info_wrapper">
                                                        <span class="contact_info_icon"><i
                                                                class="icon-envelope"></i></span>
                                                        <div class="contact_info_text"><a
                                                                href="mailto:contact@florianpascual.com">contact@florianpascual.com</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="contact_info_item">
                                                    <div class="contact_info_wrapper">
                                                        <span class="contact_info_icon"><i
                                                                class="icon-facebook-square"></i></span>
                                                        <div class="contact_info_text"><a href="#">Facebook</a></div>
                                                    </div>
                                                </li>
                                                <li class="contact_info_item">
                                                    <div class="contact_info_wrapper">
                                                        <span class="contact_info_icon"><i
                                                                class="icon-flickr"></i></span>
                                                        <div class="contact_info_text"><a href="#">Flickr</a></div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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