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
	<div class="image-wrapper">
			<?php boyo_post_thumbnail(); ?>
		</div>
		<div class="entry-header-wrapper">
			<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
			<div class="entry-meta">
				<?php boyo_the_categories(); ?>
			</div>
			<div class="boyo-intro">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</header>
</article><!-- #post-<?php the_ID(); ?> -->
