<?php
// @package create
global $woocommerce;
$header_position              = get_theme_mod( 'trade_header_position', 'header-top' );
$slide_bg                     = get_theme_mod( 'trade_slide_panel_background' );
$header_transparent_bg        = get_theme_mod( 'trade_slide_panel_background' );
$header_color_scheme          = get_theme_mod( 'trade_header_color_scheme' );
$show_header_search           = get_theme_mod( 'trade_enable_header_search' );
$show_header_search_top_bar   = get_theme_mod( 'trade_enable_header_search_top_bar' );
$show_header_cart             = get_theme_mod( 'trade_enable_header_cart' );
$show_header_cart_top_bar     = get_theme_mod( 'trade_enable_header_cart_top_bar' );
$show_slide_panel             = get_theme_mod( 'trade_enable_slide_panel' );
$header_layout                = get_theme_mod( 'trade_header_top_layout', 'inline-header' );
$show_top_bar_global          = get_theme_mod( 'trade_top_bar_show' );

//Grab the metabox values
$header_class = "main ";
$extra_body_class = "";
if(!is_archive() && !is_search()) {
$id = get_the_ID();

$show_top_bar_page = get_post_meta( $id, '_trade_header_show_top_bar', true );
$show_top_bar = ($show_top_bar_page == "default" || $show_top_bar_page == "" ) ? $show_top_bar_global : $show_top_bar_page;
	
$header_hide = get_post_meta( $id, '_trade_header_hide', true );
$header_transparent_bg = get_post_meta( $id, '_trade_header_transparent_bg', true );
$header_color_scheme_metabox = get_post_meta( $id, '_trade_header_color_scheme', true );
$header_color_scheme = ($header_color_scheme != $header_color_scheme_metabox) ? $header_color_scheme_metabox : $header_color_scheme;
if($header_transparent_bg == "yes"){ 
	$header_class .= "transparent "; 
	$extra_body_class = "transparent-header";
}
$header_class .= $header_color_scheme;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class($extra_body_class); ?>>

	<?php trade_loader(); ?>
	<?php trade_scroll_to_top(); ?>

	<?php if(!isset($header_hide) || $header_hide != "yes") { ?>
	<!-- Slide Panel -->
	<div id="slide-panel"<?php if( $slide_bg ){ echo ' style="background-image: url(' . $slide_bg . ');"'; } ?>>
		<div class="hidden-scroll">
			<div class="inner <?php if(has_nav_menu('slide_panel_mobile')) echo 'has-mobile-menu'; ?>">
				<?php wp_nav_menu( array(
					'container'			=> 'nav',
					'container_id'		=> 'slide-main-menu',
					'menu_class'        => 'collapse sidebar',
					'theme_location'	=> 'slide_panel',
					'fallback_cb' 		=> 'trade_slide_nav'
				) ); ?>

				<?php wp_nav_menu( array(
					'container'			=> 'nav',
					'container_id'		=> 'slide-mobile-menu',
					'menu_class'        => 'collapse sidebar',
					'theme_location'	=> 'slide_panel_mobile',
					'fallback_cb' 		=> 'trade_slide_nav',
					'menu' => get_post_meta( $id, '_trade_header_menu_mobile', true)
				) ); ?>

				<?php if ( is_active_sidebar( 'slide_panel' ) ) : ?>
					<div class="widget-area desktop" role="complementary">
						<?php dynamic_sidebar( 'slide_panel' ); ?>
					</div><!-- .widget-area-desktop -->
				<?php endif; ?>
				<?php if ( is_active_sidebar( 'slide_panel_mobile' ) ) : ?>
					<div class="widget-area mobile" role="complementary">
						<?php dynamic_sidebar( 'slide_panel_mobile' ); ?>
					</div><!-- .widget-area-mobile -->
				<?php endif; ?>
			</div><!-- .inner -->
		</div>
		<span id="menu-toggle-close" class="menu-toggle right close slide" data-target="slide-panel"><span></span></span>
	</div><!-- /slide-panel-->
	<?php } ?>


<div id="site-wrap">
<div id="main-container">
	<?php if($header_position != "side-header"){ // Top positioned header ?>
			<?php if(!isset($header_hide) || $header_hide != "yes") { ?>
			<header id="site-header" class="<?php echo $header_class; ?>">
				<?php if($show_header_search != "no") { ?>
				<div id="header-search" class="header-search">
					<span id="search-toggle-close" class="search-toggle right close" data-target="header-search" ></span>
					<div class="inside">
						<div class="form-wrap">
						<form role="search" method="get" id="searchform" class="searchform clear" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php $search_text = __("Search", "trade"); ?>
							<input type="text" placeholder="<?php echo $search_text; ?>" name="s" id="s" />
						</form>

						</div>
					</div>
					<div class="overlay"></div>
				</div>
				<?php } ?>
				
				<?php if($show_top_bar == "yes"){ ?>
				<div id="top-bar" class="clear">
					<div class="inside">
						<div class="left">
							<div class="left-text top-bar-item">
								<?php echo wp_kses_post(get_theme_mod( 'trade_top_bar_left' )); ?>
							</div>
						</div>
						<div class="right">
							<?php if( wp_kses_post(get_theme_mod( 'trade_top_bar_right' ))){ ?>
								<div class="right-text top-bar-item">
									<?php echo wp_kses_post(get_theme_mod( 'trade_top_bar_right' )); ?>
								</div>
							<?php } ?>
							
							<?php if($show_header_cart_top_bar == "yes" || $show_header_search_top_bar == "yes") { ?>
							<div class="secondary-nav top-bar-item clearfix">
								<?php if($woocommerce && $show_header_cart_top_bar == "yes") { ?>
								<a class="cart-icon right open" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'trade'); ?>">
								<?php if($woocommerce->cart->cart_contents_count > 0){?>
								<span class="cart-count"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
								<?php } ?>
								</a>
								<?php } ?>
								<?php if($show_header_search != "no") { ?>
									<?php if($show_header_search_top_bar == "yes") { ?>
										<span id="search-toggle-open" class="search-toggle right open" data-target="header-search" ></span>
									<?php } ?>
								<?php } ?>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<?php } ?>
				
				<div class="inside logo-and-nav clearfix">

					<?php $logo_head_tag = ( is_front_page() ) ? "h1" : "h2"; ?>
					<?php $ttrust_logo_top = ($header_color_scheme == "light") ? get_theme_mod( 'trade_logo_top_light' ) : get_theme_mod( 'trade_logo_top' ); ?>
					<?php $ttrust_logo_sticky = get_theme_mod( 'trade_logo_sticky' ); ?>

					<div id="logo" class="<?php if($ttrust_logo_sticky) echo 'has-sticky-logo'; ?>">
					<?php if( $ttrust_logo_top ) { ?>
						<<?php echo $logo_head_tag; ?> class="site-title"><a href="<?php bloginfo('url'); ?>"><img src="<?php echo $ttrust_logo_top; ?>" alt="<?php bloginfo('name'); ?>" /></a></<?php echo $logo_head_tag; ?>>
					<?php } else { ?>
						<<?php echo $logo_head_tag; ?> class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></<?php echo $logo_head_tag; ?>>
					<?php } ?>

					<?php if( $ttrust_logo_sticky ) { ?>
						<<?php echo $logo_head_tag; ?> class="site-title sticky"><a href="<?php bloginfo('url'); ?>"><img src="<?php echo $ttrust_logo_sticky; ?>" alt="<?php bloginfo('name'); ?>" /></a></<?php echo $logo_head_tag; ?>>
					<?php } else { ?>
						<<?php echo $logo_head_tag; ?> class="site-title sticky"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></<?php echo $logo_head_tag; ?>>
					<?php } ?>
					</div>

					<?php if($header_layout=="split-header inline-header"){?>
					<div class="main-nav left clearfix">
					<?php wp_nav_menu( array(
						'container'			=> 'nav',
						'container_id'		=> 'left-menu',
						'menu_class' 		=> 'main-navigation sf-menu clear',
						'theme_location'	=> 'left',
						'fallback_cb' 		=> 'trade_main_nav',
						'menu' => get_post_meta( $id, '_trade_header_menu_left', true)
					) ); ?>
					</div>
					<?php } ?>

					<div class="nav-holder">

						<div class="main-nav clearfix">
						<?php wp_nav_menu( array(
							'container'			=> 'nav',
							'container_id'		=> 'main-menu',
							'menu_class' 		=> 'main-navigation sf-menu clear',
							'theme_location'	=> 'primary',
							'fallback_cb' 		=> 'trade_main_nav',
							'menu' => get_post_meta( $id, '_trade_header_menu_main', true)
						) ); ?>
						</div>
						
						<div class="secondary-nav clearfix">

							<?php if($woocommerce && $show_header_cart != "no") { ?>
							<a class="cart-icon right open" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'trade'); ?>">
							<?php if($woocommerce->cart->cart_contents_count > 0){?>
							<span class="cart-count"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
							<?php } ?>
							</a>
							<?php } ?>

							<?php if($show_header_search == "yes") { ?>
							<span id="search-toggle-open" class="search-toggle right open" data-target="header-search" ></span>
							<?php } ?>

							<div id="menu-toggle-open" class="menu-toggle hamburger hamburger--spin right" >
							  <div class="hamburger-box" data-target="slide-menu">
							    <div class="hamburger-inner"></div>
							  </div>
							</div>

						</div>

					</div>

				</div>

			</header><!-- #site-header -->
			<?php } ?>
		<?php } ?>
	<div id="middle">