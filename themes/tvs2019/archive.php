<?php
/**
 * The template for displaying Archive pages.
 * @package create
 */


			get_header(); ?>

				<div id="primary" class="content-area">

					<header class="main entry-header">
						<h1 class="entry-title">
							<?php
								if ( is_category() ) :
									single_cat_title();

								elseif ( is_tag() ) :
									single_tag_title();

								elseif ( is_author() ) :
									printf( __( 'Author: %s', 'trade' ), '<span class="vcard">' . get_the_author() . '</span>' );

								elseif ( is_day() ) :
									printf( __( 'Day: %s', 'trade' ), '<span>' . get_the_date() . '</span>' );

								elseif ( is_month() ) :
									printf( __( 'Month: %s', 'trade' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'trade' ) ) . '</span>' );

								elseif ( is_year() ) :
									printf( __( 'Year: %s', 'trade' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'trade' ) ) . '</span>' );

								elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
									_e( 'Asides', 'trade' );

								elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
									_e( 'Galleries', 'trade');

								elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
									_e( 'Images', 'trade');

								elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
									_e( 'Videos', 'trade' );

								elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
									_e( 'Quotes', 'trade' );

								elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
									_e( 'Links', 'trade' );

								elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
									_e( 'Statuses', 'trade' );

								elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
									_e( 'Audios', 'trade' );

								elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
									_e( 'Chats', 'trade' );

								else :
									_e( 'Archives', 'trade' );

								endif;
							?>
						</h1>
						<?php // Show an optional term description.
						$term_description = term_description();

						if ( ! empty( $term_description ) ) {
						?>
						<span class="meta">
							<?php echo $term_description; ?>
						</span>
						<?php } ?>
						<span class="overlay"></span>
					</header><!-- .entry-header -->

					<?php $archive_layout = get_theme_mod( 'trade_archive_layout', 'standard' ); ?>
					<?php get_template_part( 'templates/archive', $archive_layout ); ?>

				</div><!-- #primary -->
			<?php get_footer(); ?>
