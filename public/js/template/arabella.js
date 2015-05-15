"use strict";

jQuery(document).ready(function($) {

    //Tabs About
    function Tabs() {
        [].slice.call(document.querySelectorAll('.ef-tabs')).forEach(function(el) {
            new CBPFWTabs(el);
        });
    };
    Tabs();

    //Menu Navigation 
    function Navigation() {

        var bodyEl = document.body,
        content = document.querySelector( '#close-button' ),
        openbtn = document.getElementById( 'open-button' ),
        closebtn = document.getElementById( 'close-button' ),
        isOpen = false;

        function init() {
            initEvents();
        }

        function initEvents() {
            openbtn.addEventListener( 'click', toggleMenu );
            if( closebtn ) {
                closebtn.addEventListener( 'click', toggleMenu );
            }

            // close the menu element if the target it´s not the menu element or one of its descendants..
            content.addEventListener( 'click', function(ev) {
                var target = ev.target;
                if( isOpen && target !== openbtn ) {
                    toggleMenu();
                }
            } );
        }

        function toggleMenu() {
            if( isOpen ) {
                classie.remove( bodyEl, 'show-menu' );
            }
            else {
                classie.add( bodyEl, 'show-menu' );
            }
            isOpen = !isOpen;
        }

        init();

    };

    Navigation();

    //Animation Count Up
    var numberanimation = jQuery('.number-count');
    if ((numberanimation.length > 0)) {
        numberanimation.counterUp({
            delay: 20,
            time: 1000
        });
    }

    //Back to top
    jQuery("a[href='#top']").click(function() {
        jQuery("html, body").animate({
            scrollTop: 0
        }, "slow");
        return false;
    });

    //Navigation Sub Menu Triggering
    jQuery('.trigger-sub-nav').on('click', function() {
        if (!jQuery(this).find('.subnav').is(':visible')) {
            jQuery('.subnav').slideUp(400);
            jQuery(this).find('.subnav').slideDown(400);
        } else {
            jQuery('.subnav').slideUp(400);
        }
    })

    // Tabs About Us
    jQuery('.tab').hide();
    jQuery('.tab:first').show();

    jQuery('.filter-tabs ul li a').click(function() {
        var t = jQuery(this).attr('id');
        jQuery('.tab').hide();
        jQuery('#' + t + 'C').stop(true, true).fadeIn('slow');
        jQuery('.filter-tabs ul li a').removeClass('active');
        jQuery(this).addClass('active');
    });

    // Clients Slider
    var clients = jQuery('#clients');
    if (clients.length > 0) {
        clients.owlCarousel({
            items: 6,
            itemsDesktop: [1199, 6],
            itemsDesktopSmall: [980, 6],
            itemsTablet: [768, 4],
            itemsMobile: [479, 2],
            autoPlay: true,
            stopOnHover: true,
        });
    }

    //Team Slider
    var team = jQuery('#team');
    if (team.length > 0) {
        team.owlCarousel({
            items: 3,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [980, 2],
            itemsTablet: [768, 2],
            itemsMobile: [479, 1]
        });
    }


    //Testimonials
    var testimonial = jQuery('#testimonial');
    var prev = jQuery('.prev-slide');
    var next = jQuery('.next-slide');

    if (testimonial.length > 0) {
        testimonial.owlCarousel({
            items: 1,
            itemsDesktop: [1199, 1],
            itemsDesktopSmall: [980, 1],
            itemsTablet: [768, 1],
            itemsMobile: [479, 1],
            pagination: false
        });
        prev.click(function() {
            testimonial.trigger('owl.prev');
        });
        next.click(function() {
            testimonial.trigger('owl.next');
        });
    }

    var singleportfolio = jQuery('.single-portfolio-slider');
    if (singleportfolio.length > 0) {
        singleportfolio.owlCarousel({
            items: 1,
            itemsDesktop: [1199, 1],
            itemsDesktopSmall: [980, 1],
            itemsTablet: [768, 1],
            itemsMobile: [479, 1],
            pagination: false
        });
        prev.click(function() {
            singleportfolio.trigger('owl.prev');
        });
        next.click(function() {
            singleportfolio.trigger('owl.next');
        });
    }

});


jQuery(window).load(function($) {
    // Preloader
    jQuery('.preloader').fadeOut();
    jQuery('.load').delay(1000).fadeOut('slow');
    jQuery('body').delay(1000).css({
        'overflow': 'visible'
    });

    /*Init Portfolio*/
    var blog = jQuery('#blog-grid');

    if (blog.length > 0) {
        blog.isotope({
            layoutMode: 'masonry',
            itemselector: '.blog'
        });
    };

    /*Init Portfolio*/
    var container = jQuery("#work-grid");

    if (container.length > 0) {
        container.isotope({
            layoutMode: 'masonry',
            transitionDuration: '0.7s',
            columnWidth: 60
        });
    }

        //  Load more Portfolio Masonry
        jQuery('#load-more').click(function() {
            var self = jQuery(this);
            jQuery('.load-portfolio').css('display', 'block');
            self.hide();
            var url = 'ajax/masonryportfolio.html';
            var itemLoad = 4;
            jQuery.ajax({
                url: url,
                data: {
                    itemCount: itemLoad
                }
            }).done(function(data) {
                container.isotope('insert', jQuery(data));
                jQuery('.load-portfolio').css('display', 'none');
                self.show();
            }).fail(function() {
                self.text('Error while loading!');
            });
        });

        //  Load more 3column Portfolio
        jQuery('#load-more-3column').click(function() {
            var self = jQuery(this);
            jQuery('.load-portfolio').css('display', 'block');
            self.hide();
            var url = 'ajax/portfolio-3column.html';
            var itemLoad = 3;
            jQuery.ajax({
                url: url,
                data: {
                    itemCount: itemLoad
                }
            }).done(function(data) {
                container.isotope('insert', jQuery(data));
                jQuery('.load-portfolio').css('display', 'none');
                self.show();
            }).fail(function() {
                self.text('Error while loading!');
            });
        });

        //   Load more 4 column Portfolio
        jQuery('#load-more-4column').click(function() {
            var self = jQuery(this);
            jQuery('.load-portfolio').css('display', 'block');
            self.hide();
            var url = 'ajax/portfolio-4column.html';
            var itemLoad = 4;
            jQuery.ajax({
                url: url,
                data: {
                    itemCount: itemLoad
                }
            }).done(function(data) {
                container.isotope('insert', jQuery(data));
                jQuery('.load-portfolio').css('display', 'none');
                self.show();
            }).fail(function() {
                self.text('Error while loading!');
            });
        });        





    //Filter Portfolio
    jQuery('a.filter').click(function() {
        var to_filter = jQuery(this).attr('data-filter');
        if (to_filter == 'all') {
            container.isotope({
                filter: '.mix'
            });
        } else {
            container.isotope({
                filter: '.' + to_filter
            });
        }
    });

    //Switch Classes portfolio
    jQuery('.filter').click(function() {
        jQuery('a.filter').removeClass('active');
        jQuery(this).addClass('active');
    });

});