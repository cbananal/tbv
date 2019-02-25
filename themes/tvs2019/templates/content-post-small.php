<?php
/**
 * @package create
 */

$featured_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
global $recent_posts_config;

?>

		<article <?php post_class('small'); ?>>
			<div class="inside">
			<?php if(has_post_thumbnail()) : ?>			
				<a href="<?php the_permalink() ?>" rel="bookmark" class="post-thumb"><?php the_post_thumbnail('trade_thumb_landscape', array('class' => '', 'alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?></a>
			<?php endif; ?>

			<div class="content">
				<span class="meta">
					<?php echo esc_attr( get_the_date() ); ?>
				</span>
				<h3><a href="<?php the_permalink(); ?>" rel="bookmark" alt="<?php the_title_attribute(); ?>"><?php the_title_attribute(); ?></a></h3>
				<?php if($recent_posts_config['show_excerpt'] == "yes"){ //check if lightbox mode is enabled 
					the_excerpt();
				 } ?>
				<span class="meta bottom">
					<span class="author">
						<?php echo get_avatar( get_the_author_meta('ID'), 32 ); ?><?php _e( 'by ', 'trade' ); the_author(); ?>
					</span>
				</span>
			</div>
			</div>
		</article>

