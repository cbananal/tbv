<?php
/**
 * The Template for displaying all single posts.
 *
 * @package create
 */

// Grab the metabox values
$id = get_the_ID();
$show_title = get_post_meta( $id, '_trade_title_show', true ); 
$hide_text = get_post_meta( $id, '_trade_title_hide_text', true ); 
$subtitle = get_post_meta( $id, '_trade_title_subtitle', true ); 
$title_img = get_post_meta( $id, '_trade_title_img', true );
$title_parallax = get_post_meta( $id, '_trade_title_parallax', true );
$title_alignment = get_post_meta( $id, '_trade_title_alignment', true );
$title_bg = get_post_meta( $id, '_trade_title_bg_img', true );
$title_style = "";

$header_class = $title_alignment;
if($title_parallax=='yes'){
	$header_class .= " parallax-section title-parallax";
}

get_header(); ?>

	<div id="primary" class="content-area">
		
		<?php if($show_title == "yes"){ ?>
		<header class="main entry-header <?php echo $header_class; ?>" <?php if($title_parallax=="yes"){?> data-parallax-image="<?php echo $title_bg; ?>" data-parallax-id=".title-parallax" <?php } ?>>
			<div class="inner">
			<div class="title">	
			<?php if( $title_img ) { ?>
				<img src="<?php echo $title_img; ?>">
			<?php } ?>
			<?php if ($hide_text!='yes'){?>	
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php if( $subtitle ) { ?>
					<p class="subtitle">
						<?php echo $subtitle; ?>
					</p>
				<?php } ?>
			<?php } ?>
			</div>
			</div><!-- .inner -->
		</header><!-- .entry-header -->
		<?php } //end if ?>
		
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<div class="body-wrap clear">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php echo render_rich_snippets_for_pages(); ?>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'trade' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->

				<footer class="post-nav">
					<?php if(get_theme_mod( 'trade_show_social_on_projects', 'no' ) == 'yes') {
						trade_social_sharing(); 
					} ?>
					
				</footer>

			</article><!-- #post-## -->
			</div><!-- .body-wrap -->
			

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
		<?php trade_the_post_nav(); ?>
	</div><!-- #primary -->
<?php get_footer(); ?>