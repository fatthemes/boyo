<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Boyo
 */

if ( ! function_exists( 'boyo_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function boyo_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		$posted_updated = esc_html__( 'Published: ', 'boyo' );
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			$posted_updated = esc_html__( 'Last Updated: ', 'boyo' );
		}
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);
		$posted_on = $posted_updated . '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'boyo_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function boyo_posted_by() {
		if ( function_exists( 'get_coauthors' ) ) {
			$coauthors = get_coauthors();
			if ( ! empty( $coauthors ) ) {
				$byline = '<ul class="coauthors-list">';
				foreach ( $coauthors as $coauthor ) {
					$byline .= '<li class="coauthors-list-item">';
					$byline .= '<div class="author vcard">' . get_avatar( $coauthor->get( 'ID' ), 48 ) . '<a class="url fn n" href="' . esc_url( get_author_posts_url( $coauthor->get( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name', $coauthor->get( 'ID' ) ) ) . '</a></div>';
					$byline .= '</li>';
				}
				$byline .= '</ul>';
			}
		} else {
			$byline = '<span class="author vcard">' . get_avatar( get_the_author_meta( 'ID' ), 48 ) . '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
		}

		echo '<div class="byline"> ' . $byline . '</div>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'boyo_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function boyo_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			boyo_the_tags();
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'boyo' ),
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

if ( ! function_exists( 'boyo_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function boyo_post_thumbnail() {
		if ( post_password_required() || is_attachment() ) {
			return;
		}

		if ( is_singular() ) :
			if ( has_post_thumbnail() && ! get_post_format() ) : ?>
							<div class="post-thumbnail">
								<figure class="featured-image">
									<?php the_post_thumbnail(); ?>
										<?php if ( 'post' === get_post_type() ) : ?>
										<figcaption class="featured-image-caption">
											<?php boyo_the_featured_image_caption(); ?>
										</figcaption>
									<?php endif; ?>
								</figure>
							</div><!-- .post-thumbnail -->
				<?php
			endif;
		else :
			if ( has_post_thumbnail() ) {
				?>
					<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
				<?php boyo_the_post_format_icon( get_post_format() ); ?>
					</a>
					<?php
			} else {
				?>
					<a class="no-post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php boyo_the_post_format_icon( get_post_format() ); ?>
					</a>
					<?php
			}
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'boyo_the_featured_image_caption' ) ) :
	/**
	 * Displays captions under featured images.
	 */
	function boyo_the_featured_image_caption() {
		echo esc_html( get_post( get_post_thumbnail_id() )->post_excerpt );
	}
endif;

if ( ! function_exists( 'boyo_the_post_format_icon' ) ) :
	/**
	 * Display icons in post formats.
	 *
	 * @param string $post_format post format name.
	 * @return string
	 */
	function boyo_the_post_format_icon( $post_format = '' ) {
		if ( ! in_array( $post_format, array( 'gallery', 'audio', 'video', 'link' ) ) ) {
			return;
		}
		switch ( $post_format ) {
			case 'link':
				$icon = '<svg version="1.1" id="link" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve">
           <g>
               <circle fill="#FFFFFF" cx="29.781" cy="30" r="28.5"/>
               <path d="M29.781,59c-15.991,0-29-13.01-29-29s13.009-29,29-29C45.771,1,58.78,14.01,58.78,30S45.771,59,29.781,59z M29.781,2
                   c-15.439,0-28,12.561-28,28c0,15.439,12.561,28,28,28C45.22,58,57.78,45.439,57.78,30C57.78,14.561,45.22,2,29.781,2z"/>
           </g>
           <g id="link_1_">
               <path d="M30.604,24.99l-0.975,1.747c0.875,0.487,1.577,1.221,2.031,2.12c1.249,2.473,0.253,5.502-2.221,6.751l-8.919,4.504
                   c-1.198,0.605-2.561,0.708-3.835,0.288c-1.275-0.42-2.311-1.311-2.916-2.51c-0.605-1.197-0.707-2.56-0.288-3.834
                   c0.419-1.275,1.311-2.311,2.509-2.915l5.605-2.831l-0.901-1.785l-5.605,2.831c-1.675,0.845-2.921,2.292-3.507,4.076
                   c-0.586,1.782-0.444,3.687,0.402,5.361c0.846,1.675,2.293,2.92,4.076,3.507c0.722,0.237,1.464,0.355,2.202,0.355
                   c1.085,0,2.163-0.255,3.159-0.758l8.919-4.504c3.458-1.746,4.851-5.98,3.104-9.438C32.811,26.698,31.827,25.673,30.604,24.99z"/>
               <path d="M46.578,21.324c-1.747-3.458-5.979-4.851-9.438-3.104l-8.919,4.504c-3.458,1.747-4.851,5.979-3.105,9.436
                   c0.404,0.8,0.946,1.505,1.611,2.095l1.327-1.496c-0.476-0.422-0.864-0.927-1.153-1.5c-1.249-2.472-0.252-5.5,2.221-6.75l8.92-4.504
                   c2.473-1.25,5.501-0.252,6.75,2.22c1.249,2.473,0.253,5.502-2.221,6.751l-6.167,3.114l-0.274,0.139l0.9,1.785l6.443-3.253
                   C46.932,29.016,48.324,24.782,46.578,21.324z"/>
           </g>
           </svg>';
				break;
			case 'gallery':
				$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px"
                height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve">
           <g id="play">
               <circle fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" cx="29.781" cy="30" r="28.5"/>
           </g>
           <g id="camera">
               <polygon stroke="#000000" stroke-miterlimit="10" points="37.683,20.75 37.683,17.833 22.099,17.833 22.099,20.75 10.308,20.75 
                   10.308,42.25 49.474,42.25 49.474,20.75 	"/>
               <circle fill="none" stroke="#FFFFFF" stroke-miterlimit="10" cx="29.891" cy="31.283" r="7.292"/>
           </g>
           </svg>';
				break;
			case 'audio':
				$icon = '<svg version="1.1" id="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve">
           <circle fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" cx="30" cy="30" r="28.5"/>
           <path d="M43.529,34.881V12.22l-20.91,5.669v20.408c-0.779-0.715-1.899-1.132-3.188-1.132c-0.772,0-1.556,0.146-2.331,0.434
               c-2.892,1.072-4.72,3.842-4.077,6.173c0.466,1.686,2.114,2.774,4.2,2.774c0.773,0,1.557-0.146,2.331-0.434
               c2.347-0.871,3.993-2.858,4.187-4.822h0.022V18.764l18.621-5.05v18.703c-0.779-0.711-1.895-1.126-3.178-1.126
               c-0.767,0-1.551,0.146-2.331,0.433c-2.891,1.074-4.719,3.845-4.076,6.176c0.465,1.686,2.113,2.774,4.2,2.774
               c0.771,0,1.555-0.146,2.331-0.436C41.891,39.29,43.614,37.011,43.529,34.881z M19.158,45.04c-0.647,0.24-1.298,0.362-1.935,0.362
               c-1.581,0-2.768-0.741-3.098-1.934c-0.49-1.775,1.023-3.928,3.374-4.798c0.646-0.241,1.296-0.363,1.932-0.363
               c1.582,0,2.769,0.741,3.098,1.936c0.06,0.218,0.088,0.44,0.09,0.666v0.028C22.617,42.545,21.207,44.279,19.158,45.04z
                M38.933,39.169c-0.646,0.239-1.297,0.36-1.933,0.36c-1.581,0-2.769-0.741-3.099-1.935c-0.49-1.772,1.022-3.925,3.371-4.798
               c0.647-0.24,1.298-0.362,1.935-0.362c1.58,0,2.768,0.742,3.099,1.937c0.053,0.191,0.071,0.389,0.079,0.587v0.102h0.012
               C42.396,36.668,40.982,38.406,38.933,39.169z"/>
           </svg>';
				break;
			case 'video':
				$icon = '<svg version="1.1" id="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve">
           <circle fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" cx="30" cy="30" r="28.5"/>
           <path fill="none" stroke="#000000" stroke-width="0.75" stroke-miterlimit="10" d="M46.43,30.252L22.749,16.58
               c-0.101-0.058-0.224-0.058-0.324,0s-0.163,0.165-0.163,0.281v27.345c0,0.116,0.063,0.225,0.163,0.283
               c0.05,0.028,0.106,0.042,0.161,0.042c0.057,0,0.113-0.014,0.163-0.042L46.43,30.814c0.102-0.059,0.164-0.166,0.164-0.281
               S46.531,30.311,46.43,30.252z M22.911,43.645V17.422L45.62,30.533L22.911,43.645z"/>
           </svg>';
				break;

		}
		?>
		<span class="<?php echo esc_attr( $post_format ); ?>-post-format-icon post-format-icon">
			<?php echo $icon; // WPCS: XSS OK. ?>
		</span>
		<?php
	}
endif;

if ( ! function_exists( 'boyo_the_categories' ) ) :
	/**
	 * Displays categories.
	 */
	function boyo_the_categories() {
		/* translators: used between list items, there is a space after the comma */
		$category_list = get_the_category_list( esc_html__( ', ', 'boyo' ) );
		if ( $category_list ) {
			/* translators: 1: list of categories. */
			echo '<span class="cat-links">' . $category_list . '</span><br/>'; // WPCS: XSS OK.
		}
	}
endif;

if ( ! function_exists( 'boyo_the_tags' ) ) :
	/**
	 * Displays tags.
	 */
	function boyo_the_tags() {
		$posttags = get_the_tags();
		if ( $posttags ) {
			foreach ( $posttags as $tag ) {
				echo ' <a class="tag" href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">#' . esc_html( $tag->name ) . '</a>';
			}
		}
	}
endif;

if ( ! function_exists( 'boyo_the_authors' ) ) :
	/**
	 * Displays authors.
	 */
	function boyo_the_authors() {
		$title_string = '';
		$authors = array();
		if ( function_exists( 'get_coauthors' ) ) {
			$authors_objects = get_coauthors();
			foreach ( $authors_objects as $author ) {
				$authors[] = $author->get( 'ID' );
			}
			$title_string = esc_html__( 'About authors', 'boyo' );
		}

		if ( 2 > count( $authors ) ) {
			$authors = (array) get_the_author_meta( 'ID' );
			$title_string = esc_html__( 'About author', 'boyo' );
		}
		$output = '';
		if ( ! empty( $authors ) ) {
			$output .= '<h3 class="post-authors-list-title">' . $title_string . '</h3>';
			$output .= '<ul class="post-authors-list">';
			foreach ( $authors as $author_id ) {
				$output .= '<li class="post-authors-list-item"><div class="post-authors-list-info vcard">';
				$output .= get_avatar( $author_id, 64 );
				$output .= '<div class="post-authors-list-name"><p class="fn url"><a href="' . get_the_author_meta( 'user_url', $author_id ) . '">' . get_the_author_meta( 'display_name', $author_id ) . '</a></p>';
				$output .= '<p class="post-authors-list-bio">' . esc_html( get_the_author_meta( 'description', $author_id ) ) . '</p></div>';
				$output .= '</div></li>';
			}
			$output .= '</ul>';
		}
		echo $output; // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'boyo_customize_css' ) ) :

	/**
	 * Custom css header output
	 */
	function boyo_customize_css() {

		$base_css = '@media (min-width: 961px) { .main-menu .current-menu-ancestor > a::after { border-bottom: 4px solid ' . esc_attr( get_theme_mod( 'menu_underline_color', '#ffd73e' ) ) . ';}}';
		$base_css .= '.main-menu .menu-item > a:active::after, .main-menu .menu-item > a:hover::after, .main-menu .current-menu-item > a::after { border-bottom: 4px solid ' . esc_attr( get_theme_mod( 'menu_underline_color', '#ffd73e' ) ) . ';}';
		wp_add_inline_style( 'boyo-base', $base_css );

		$archive_css = '.site-main, .main-navigation { background-color: ' . esc_attr( get_theme_mod( 'main_home_content_bg_color', '#f8f8f8' ) ) . '; }';
		$archive_css .= '.link-post-format-wrapper .entry-header, .link-post-format-wrapper .entry-content { background-color: ' . esc_attr( get_theme_mod( 'link_format_bg_color', '#edf7fa' ) ) . '; }';
		$archive_css .= '.quote-post-format-wrapper .entry-header, .quote-post-format-wrapper .entry-content { background-color: ' . esc_attr( get_theme_mod( 'quote_format_bg_color', '#fef0f0' ) ) . '; }';
		$archive_css .= '.format-aside .aside-content-wrapper { background-color: ' . esc_attr( get_theme_mod( 'aside_format_bg_color', '#c1e4de' ) ) . '; }';
		$archive_css .= '@media (min-width: 961px) { .sticky .entry-header { background-color: ' . esc_attr( get_theme_mod( 'main_home_content_bg_color', '#f8f8f8' ) ) . '; }}';
		wp_add_inline_style( 'boyo-archive', $archive_css );
	}

	add_action( 'wp_enqueue_scripts', 'boyo_customize_css' );

endif;
