<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Boyo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-header-wrapper">
			<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
			<div class="boyo-intro">
				<?php the_excerpt(); ?>
			</div>
		</div>
		<div class="image-wrapper">
			<?php boyo_post_thumbnail(); ?>
		</div>
	</header>

	<footer class="entry-footer">
		<?php boyo_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
