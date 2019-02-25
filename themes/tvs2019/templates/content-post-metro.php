<?php
/**
 * The template used for displaying project thumbs
 *
 * @package Trade
 * @since 1.0
 */
$id = get_the_ID();
global $post;
global $portfolio_config;

$size_class = '';
$details_class = '';

$size = get_post_meta( $id, '_trade_post_metro_image_size', true );
$thumb_size = 'trade_thumb_' . $size;
$size_class = 'masonry-'.$size;

?>

					<div class="post small<?php echo ' '. $size_class;?>" id="project-<?php echo $post->ID; ?>">
						<div class="inside">
							
							<div class="details <?php echo $details_class; ?>" >
								<div class="text">
									<span class="meta">
										<?php echo esc_attr( get_the_date() ); ?>
									</span>
									<div class="title" >
										<?php the_title( '<h3 class="entry-title" style="">', "</h3>\n" );?>
									</div>
								</div>
							</div>

							<div class="overlay" style=""></div>
							
							<a href="<?php the_permalink(); ?>" alt="<?php echo the_title_attribute( 'echo=0' ); ?>"></a>
						
						<?php if( has_post_thumbnail() ) {							
							the_post_thumbnail( $thumb_size, array( 'class' => '', 'alt' => '' . the_title_attribute( 'echo=0' ) . '', 'title' => '' . the_title_attribute( 'echo=0' ) . '' ) );
					 	} ?>
						</div>
					</div><!-- #post->ID -->
