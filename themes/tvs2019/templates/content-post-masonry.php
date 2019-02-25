<?php
/**
 * @package create
 */

global $post_meta;

$size = get_post_meta( $id, '_trade_post_featured_image_size', true );
$thumb_size = 'trade_thumb_' . $size;
?>


		<article <?php post_class('small'); ?>>
			<div class="inside">
				<?php if(has_post_thumbnail()) : ?>			
					<a href="<?php the_permalink() ?>" rel="bookmark" class="post-thumb"><?php the_post_thumbnail( $thumb_size, array( 'class' => '', 'alt' => '' . the_title_attribute( 'echo=0' ) . '', 'title' => '' . the_title_attribute( 'echo=0' ) . '' ) ); ?></a>
				<?php endif; ?>

			<div class="content">
				<span class="meta">
					<?php echo esc_attr( get_the_date() ); ?>
				</span>
				<h3><a href="<?php the_permalink(); ?>" rel="bookmark" alt="<?php the_title_attribute(); ?>"><?php the_title_attribute(); ?></a></h3>
				<?php $global_show_excerpts = get_theme_mod( 'create_archive_show_excerpt', 'yes' ); ?>
				<?php if($global_show_excerpts == 'yes' && is_archive() || $post_meta['show_excerpt'] == 'yes'){
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
