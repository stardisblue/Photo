<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Arabella - HTML Theme</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0" />

        <!-- Google Web Font -->
        <link href="<?= WEB_ROOT ?>/public/css/template/inconsolata.css" rel="stylesheet" type="text/css">
        <link href="<?= WEB_ROOT ?>/public/css/template/source-sans-pro-extralight.css" rel="stylesheet" type="text/css">
        
        <link rel="stylesheet" href="<?= WEB_ROOT ?>/public/css/bootstrap.min.css">

        <!-- Tabs -->
        <link rel="stylesheet" type="text/css" href="<?= WEB_ROOT ?>/public/css/template/tabs.css" />
        <link rel="stylesheet" type="text/css" href="<?= WEB_ROOT ?>/public/css/template/tabstyles.css" />

        <!-- Costum Styles -->
        <link rel="stylesheet" href="<?= WEB_ROOT ?>/public/css/template/main.css">
        <link rel="stylesheet" href="<?= WEB_ROOT ?>/public/css/template/responsive.css">
    </head>

    <body>
        <div class="preloader">
            <span class="load"></span>
        </div>

        <div class="menu-wrap">
            <div class="menu-content">
                <div class="container">
                    <div class="row">
                        <div class="navigation"> 
                            <span class="pe-7s-left-arrow close-menu" id="close-button"></span>
                            <div class="menu-logo hidden-xs">
                                <img src="img/menu_logo.png" alt="logo" />
                            </div>
                        </div>  
                        <div class="col-md-8 col-md-offset-2 col-xs-12">
                            <div class="col-md-6 col-sm-6">
                                <nav class="menu">
                                    <div class="menu-list">
                                        <ul>
                                            <li class="trigger-sub-nav"><a href="#">Home</a>
                                                <ul class="subnav">
                                                    <li><a href="index.html">- Masonry</a></li>
                                                    <li><a href="index-3column.html">- 3 Column</a></li>
                                                    <li><a href="index-4column.html">- 4 Column</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="about.html">About</a></li>
                                            <li class="trigger-sub-nav"><a href="#">Blog</a>
                                                <ul class="subnav">
                                                    <li><a href="blog-masonry.html">- Masonry</a></li>
                                                    <li><a href="blog-3column.html">- 3 Column</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="services.html">Services</a></li>
                                            <li><a href="contact.html">Contact</a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <div class="col-md-6 col-sm-6 hidden-xs">
                                <div class="menu-contact-information">
                                    <span class="menu-email">info@email.com</span>
                                    <span class="menu-tel">Tel: +011 136 8452<br /> +031 136 8452</span>
                                    <span class="menu-address">135 THE Street, CITY,<br/> Victoria 3000 CANADA</span>
                                    <div class="menu-social-icons">
                                        <ul>
                                            <li><a href="#"><span class="iconmoon-facebook"></span></a></li>
                                            <li><a href="#"><span class="iconmoon-twitter"></span></a></li>
                                            <li><a href="#"><span class="iconmoon-linkedin2"></span></a></li>
                                            <li><a href="#"><span class="iconmoon-dribbble"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header">
            <div class="container">
                <div class="logo">
                    <a href="index.html">
                        <img src="img/logo.png" alt="logo" />
                    </a>
                </div>
                <button class="main-menu-indicator" id="open-button">
                    <span></span>
                </button>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="portfolio-wrapper">
                    <div class="works-filter">
                        <a href="javascript:void(0)" class="filter active" data-filter="mix">All</a>
                        <a href="javascript:void(0)" class="filter" data-filter="branding">Branding</a>
                        <a href="javascript:void(0)" class="filter" data-filter="web">Web</a>
                        <a href="javascript:void(0)" class="filter" data-filter="art">Art</a>
                        <a href="javascript:void(0)" class="filter" data-filter="logos">Logo</a>
                    </div>
                    <div id="work-grid" class="js-masonry">
                        <!-- Begin of Thumbs Portfolio -->
                        <div class="col-md-3 col-sm-3 col-xs-12 mix branding">
                            <div class="img masonry-height">
                                <img src="http://arabella.elitefingers.com/html/img/portfolio/image_1.jpg" alt="Portfolio Item">
                                <div class="hover-overlay">
                                    <div class="hover-overlay-inner">
                                        <div class="overlay-view">
                                            <a href="single-project.html">
                                                <span class="project-name">PROJECT NAME</span>
                                                <hr class="split-line">
                                                <span class="category-description">Branding Design</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 mix web">
                            <div class="img masonry-height">
                                <img src="http://arabella.elitefingers.com/html/img/portfolio/image_2.jpg" alt="Portfolio Item">
                                <div class="hover-overlay">
                                    <div class="hover-overlay-inner">
                                        <div class="overlay-view">
                                            <a href="single-project.html">
                                                <span class="project-name">PROJECT NAME</span>
                                                <hr class="split-line">
                                                <span class="category-description">Branding Design</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 mix art">
                            <div class="img masonry-height">
                                <img src="http://arabella.elitefingers.com/html/img/portfolio/image_3.jpg" alt="Portfolio Item">
                                <div class="hover-overlay">
                                    <div class="hover-overlay-inner">
                                        <div class="overlay-view">
                                            <a href="single-project.html">
                                                <span class="project-name">PROJECT NAME</span>
                                                <hr class="split-line">
                                                <span class="category-description">Branding Design</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 mix logos">
                            <div class="img masonry-height">
                                <img src="http://arabella.elitefingers.com/html/img/portfolio/image_4.jpg" alt="Portfolio Item">
                                <div class="hover-overlay">
                                    <div class="hover-overlay-inner">
                                        <div class="overlay-view">
                                            <a href="single-project.html">
                                                <span class="project-name">PROJECT NAME</span>
                                                <hr class="split-line">
                                                <span class="category-description">Branding Design</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 mix logos">
                            <div class="img masonry-height">
                                <img src="http://arabella.elitefingers.com/html/img/portfolio/image_6.jpg" alt="Portfolio Item">
                                <div class="hover-overlay">
                                    <div class="hover-overlay-inner">
                                        <div class="overlay-view">
                                            <a href="single-project.html">
                                                <span class="project-name">PROJECT NAME</span>
                                                <hr class="split-line">
                                                <span class="category-description">Branding Design</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 mix branding">
                            <div class="img masonry-height">
                                <img src="http://arabella.elitefingers.com/html/img/portfolio/image_7.jpg" alt="Portfolio Item">
                                <div class="hover-overlay">
                                    <div class="hover-overlay-inner">
                                        <div class="overlay-view">
                                            <a href="single-project.html">
                                                <span class="project-name">PROJECT NAME</span>
                                                <hr class="split-line">
                                                <span class="category-description">Branding Design</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 mix art">
                            <div class="img masonry-height">
                                <img src="http://arabella.elitefingers.com/html/img/portfolio/image_5.jpg" alt="Portfolio Item">
                                <div class="hover-overlay">
                                    <div class="hover-overlay-inner">
                                        <div class="overlay-view">
                                            <a href="single-project.html">
                                                <span class="project-name">PROJECT NAME</span>
                                                <hr class="split-line">
                                                <span class="category-description">Branding Design</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 mix branding">
                            <div class="img masonry-height">
                                <img src="http://arabella.elitefingers.com/html/img/portfolio/image_8.jpg" alt="Portfolio Item">
                                <div class="hover-overlay">
                                    <div class="hover-overlay-inner">
                                        <div class="overlay-view">
                                            <a href="single-project.html">
                                                <span class="project-name">PROJECT NAME</span>
                                                <hr class="split-line">
                                                <span class="category-description">Branding Design</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 mix branding">
                            <div class="img masonry-height">
                                <img src="http://arabella.elitefingers.com/html/img/portfolio/image_12.jpg" alt="Portfolio Item">
                                <div class="hover-overlay">
                                    <div class="hover-overlay-inner">
                                        <div class="overlay-view">
                                            <a href="single-project.html">
                                                <span class="project-name">PROJECT NAME</span>
                                                <hr class="split-line">
                                                <span class="category-description">Branding Design</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 mix art">
                            <div class="img masonry-height">
                                <img src="http://arabella.elitefingers.com/html/img/portfolio/image_12.jpg" alt="Portfolio Item">
                                <div class="hover-overlay">
                                    <div class="hover-overlay-inner">
                                        <div class="overlay-view">
                                            <a href="single-project.html">
                                                <span class="project-name">PROJECT NAME</span>
                                                <hr class="split-line">
                                                <span class="category-description">Branding Design</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 mix branding">
                            <div class="img masonry-height">
                                <img src="http://arabella.elitefingers.com/html/img/portfolio/image_12.jpg" alt="Portfolio Item">
                                <div class="hover-overlay">
                                    <div class="hover-overlay-inner">
                                        <div class="overlay-view">
                                            <a href="single-project.html">
                                                <span class="project-name">PROJECT NAME</span>
                                                <hr class="split-line">
                                                <span class="category-description">Branding Design</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 mix logos">
                            <div class="img masonry-height">
                                <img src="http://arabella.elitefingers.com/html/img/portfolio/image_12.jpg" alt="Portfolio Item">
                                <div class="hover-overlay">
                                    <div class="hover-overlay-inner">
                                        <div class="overlay-view">
                                            <a href="single-project.html">
                                                <span class="project-name">PROJECT NAME</span>
                                                <hr class="split-line">
                                                <span class="category-description">Branding Design</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End  of Thumbs Portfolio -->
                    </div>
                    <div class="load-more">
                        <a href="javascript:void(0)" id="load-more">LOAD MORE</a>
                        <div class="load-portfolio">
                            <div class="loading">
                                <span class="ball1"></span>
                                <span class="ball2"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="footer-wrapper">
                    <div class="footer-content">
                        <div class="social-media">
                            <ul>
                                <li><a href="#">FACEBOOK</a></li>
                                <li><a href="#">TWITTER</a></li>
                                <li><a href="#">LINKEDIN</a></li>
                                <li><a href="#">DRIBBBLE</a></li>
                                <li><a href="#">FLICKR</a></li>
                                <li><a href="#">GOOGLE+</a></li>
                            </ul>
                        </div>
                        <p>2015 © ARABELLA Portfolio Template. All rights Reserved.</p>
                    </div>
                    <span class="move-top">
                        <a href="#top"><i class="pe-7s-angle-up"></i></a>
                    </span>
                </div>
            </div>
        </footer>

        <script src="<?= WEB_ROOT ?>/public/js/template/jquery-1.11.2.min.js"></script>
        <script src="<?= WEB_ROOT ?>/public/js/template/bootstrap.min.js"></script>
        <script src="<?= WEB_ROOT ?>/public/js/template/classie.js"></script>
        <script src="<?= WEB_ROOT ?>/public/js/template/isotope.pkgd.min.js"></script>
        <script src="<?= WEB_ROOT ?>/public/js/template/waypoints.min.js"></script>
        <script src="<?= WEB_ROOT ?>/public/js/template/jquery.counterup.min.js"></script>
        <script src="<?= WEB_ROOT ?>/public/js/template/owl.carousel.min.js"></script>
        <script src="<?= WEB_ROOT ?>/public/js/template/tabs.js"></script>
        <script src="<?= WEB_ROOT ?>/public/js/template/arabella.js"></script>
    </body>

</html>