<!DOCTYPE html>
<html lang="en" class="modernizr-no-js">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta charset="utf-8" />

        <link rel="preconnect" href="//ajax.googleapis.com" />

        <meta http-equiv="cleartype" content="on" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <meta name="msapplication-tap-highlight" content="no" />
        <meta name="description" content="" />

        <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>

        <!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/media/stylesheets/app.css" />-->
        <!-- <script src="<?php echo get_template_directory_uri() ?>/media/javascripts/modernizr.js"></script> -->
        <?php echo wp_head() ?>
    </head>
    <body <?php body_class(''); ?>>
	    <div class="wrapper">
		    <header class="main-header">
			    <section class="header-topbar">
				    <div class="row">
				    	<p><a href="#" class="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a><a href="reviews/" target="_blank">Lees klantbeoordelingen <?php echo klantenvertellen_stars() ?></a></p>
				    </div>
			    </section>
			    <section class="header-middle">
				    <div class="row">
					    <div class="large-4 columns">
						    <div class="header-logo">
							     <a href="<?php echo site_url(); ?>"><i class="m-icon icon--ui__logo_big"><svg><use xlink:href="<?php echo get_template_directory_uri() ?>/media/images/sprites/ui.svg#logo_big" xmlns:xlink="http://www.w3.org/1999/xlink"></use></svg></i></a>
						    </div>
					    </div>
					    <div class="large-7 columns__right" style="text-align: right;">
						    <span class="header-text">
							    <p><strong>Vragen of advies?</strong>  Bel <a href="whatsapp://">0522 - 820991</a>  &nbsp;<a href="tel:+31627311884"><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp; 06 - 27311884</a></p>
						    </span>
					    </div>
				    </div>
				    <div class="row">
					    <nav class="header-menu">
						    <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
					    </nav>
				    </div>
			    </section>
		    </header>