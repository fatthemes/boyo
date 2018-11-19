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
	<div class="link-post-format-wrapper">
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_content(); ?>
		<?php boyo_the_post_format_icon( get_post_format() ); ?>
	</div><!-- .entry-content -->
</div>
</article><!-- #post-<?php the_ID(); ?> -->
