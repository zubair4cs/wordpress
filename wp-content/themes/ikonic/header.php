<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<?php wp_head(); ?>
</head>
<body>
<style>
.pt-4, .py-4 {
    padding-top: 3.5rem !important;
}
</style>
<nav class="navbar navbar-expand-lg py-4 navigation header-padding " id="navbar">
		<div class="container-fluid">
		  <a class="navbar-brand" href="index.html">
		  	<img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt="" class="img-fluid">
		  </a>

		  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
			<span class="fa fa-bars"></span>
		  </button>
	  
		  <div class="collapse navbar-collapse text-center" id="navbarsExample09">
			<?php
            wp_nav_menu(array(
            'theme_location' => 'primary-menu',
            'menu_class'     => 'navbar-nav',
            'container'      => false,
            'walker'         => new WP_Bootstrap_Navwalker(),
            ));
    ?> 

			<a href="#" class="btn btn-solid-border d-none d-lg-block">Get an estimate <i class="fa fa-angle-right ml-2"></i></a>
		  </div>
		</div>
	</nav>