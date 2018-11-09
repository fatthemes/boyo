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
		<?php boyo_post_thumbnail(); ?>
	</header><!-- .entry-header -->
</article><!-- #post-<?php the_ID(); ?> -->
