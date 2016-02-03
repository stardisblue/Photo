<div class="wrapper404">
    <div class="container404">
        <h1 class="title404">404 Error</h1>
        <form name="search_field" method="post" action="<?= WEB_ROOT ?>/search" class="search_form search404">
            <input type="text" name="search" class="field_search">
            <a href="javascript:void(0);" class="search_button"><i class="icon-search"></i>Search</a>
        </form>
        <div class="clear"></div>
    </div>
</div>
<div class="custom_bg img_bg"></div>

<div class="content_bg"></div>
<script type="text/javascript" src="<?= WEB_ROOT ?>/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= WEB_ROOT ?>/js/modules.js"></script>
<script type="text/javascript" src="<?= WEB_ROOT ?>/js/theme.js"></script>
<script>
    jQuery(document).ready(function(){
        "use strict";
        jQuery('.wrapper404').css('margin-top', -1*(jQuery('.wrapper404').height()/2)+(jQuery('header.main_header').height()-30)/2);
    });
    jQuery(window).resize(function(){
        "use strict";
        jQuery('.wrapper404').css('margin-top', -1*(jQuery('.wrapper404').height()/2)+(jQuery('header.main_header').height()-30)/2);
    });
</script>