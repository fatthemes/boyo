<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Boyo
 */

if (!function_exists('boyo_posted_on')):
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function boyo_posted_on()
{
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    $posted_updated = esc_html__('Published: ', 'boyo');
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        $posted_updated = esc_html__('Last Updated: ', 'boyo');
    }
    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( DATE_W3C ) ),
        esc_html( get_the_modified_date() )
    );
    $posted_on = $posted_updated . '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
    echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
}
endif;

if (!function_exists('boyo_posted_by')):
    /**
     * Prints HTML with meta information for the current author.
     */
    function boyo_posted_by()
{
        if (function_exists('get_coauthors')) {
            $coauthors = get_coauthors();
            if(!empty($coauthors)) {
                $byline = '<ul class="coauthors-list">';
                foreach($coauthors as $coauthor) {
                    $byline .= '<li class="coauthors-list-item">';
                    $byline .= '<div class="author vcard">' . get_avatar($coauthor->get('ID'), 32) . '<a class="url fn n" href="' . esc_url(get_author_posts_url($coauthor->get('ID'))) . '">' . esc_html(get_the_author_meta( 'display_name', $coauthor->get('ID') )) . '</a></div>';
                    $byline .= '</li>';
                }
                $byline .= '</ul>';
            }
        } else {
            $byline = sprintf(
                /* translators: %s: post author. */
                esc_html_x('By %s', 'post author', 'boyo'),
                '<span class="author vcard">' . get_avatar($coauthor->get('ID'), 32) . '<a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
            );
        }

        echo '<div class="byline"> ' . $byline . '</div>'; // WPCS: XSS OK.

    }
endif;

if (!function_exists('boyo_entry_footer')):
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function boyo_entry_footer()
{
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            boyo_the_tags();
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Edit <span class="screen-reader-text">%s</span>', 'boyo'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;

if (!function_exists('boyo_post_thumbnail')):
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function boyo_post_thumbnail()
{
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()):
        ?>

								<div class="post-thumbnail">
									<figure class="single-post-featured-image">
										<?php the_post_thumbnail();?>
										<figcaption class="single-post-featured-image-caption">
											<?php boyo_the_featured_image_caption();?>
										</figcaption>
									</figure>
								</div><!-- .post-thumbnail -->

							<?php else: ?>

		<a class="post-thumbnail" href="<?php the_permalink();?>" aria-hidden="true" tabindex="-1">
			<?php
the_post_thumbnail('post-thumbnail', array(
        'alt' => the_title_attribute(array(
            'echo' => false,
        )),
    ));
    ?>
		</a>

		<?php
endif; // End is_singular().
}
endif;

if (!function_exists('boyo_the_featured_image_caption')):
    function boyo_the_featured_image_caption()
	{
        echo esc_html(get_post(get_post_thumbnail_id())->post_excerpt);
	}
endif;

if (!function_exists('boyo_the_categories')):
    function boyo_the_categories()
	{
        /* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list(esc_html__(', ', 'boyo'));
		if ($categories_list) {
			/* translators: 1: list of categories. */
			echo '<span class="cat-links">' . $categories_list . '</span><br/>'; // WPCS: XSS OK.
		}
	}
endif;

if (!function_exists('boyo_the_tags')):
    function boyo_the_tags()
	{
        $posttags = get_the_tags();
		if ($posttags) {
			foreach($posttags as $tag) {
				echo  ' <a class="tag" href="' . get_tag_link($tag->term_id) . '">#' . $tag->name . '</a>';
			}
		}
	}
endif;

if (!function_exists('boyo_the_authors')):
    function boyo_the_authors()
	{
		$title_string = '';
		$authors = array();
		if(function_exists('get_coauthors')) {
			$authors_objects = get_coauthors();
			foreach($authors_objects as $author){
				$authors[] = $author->get('ID');
			}
			$title_string = esc_html__('About authors', 'boyo');
		}
        //print_r($authors);
        
		if( 2 > count($authors)) {
			$authors = (array) get_the_author_meta('ID');
			$title_string = esc_html__('About author', 'boyo');
		}
		$output = '';
		if(!empty($authors)) {
			$output .= '<h3 class="post-authors-list-title">' . esc_html($title_string) . '</h3>';
			$output .= '<ul class="post-authors-list">';
			foreach($authors as $author_id) {
				$output .= '<li class="post-authors-list-item"><div class="post-authors-list-info vcard">';
				$output .= get_avatar(absint($author_id), 64);
				$output .= '<div class="post-authors-list-name"><p class="fn url"><a href="' . get_the_author_meta('user_url', absint($author_id)) . '">' . get_the_author_meta('display_name', $author_id) . '</a></p>';
				$output .= '<p class="post-authors-list-bio">' . get_the_author_meta('description', absint($author_id)) . '</p></div>';
				$output .= '</div></li>';
			}
			$output .= '</ul>';
		}
		echo $output;
	}
endif;
