<?php
/**
 * Template part for displaying AMP navigation
 *
 * @package Boyo
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
<amp-state id="navMenuExpanded">
	<script type="application/json">false</script>
</amp-state>
<amp-state id="searchFormExpanded">
	<script type="application/json">false</script>
</amp-state>
<nav
	id="site-navigation"
	class="main-navigation"
	[class]="'main-navigation' + ( navMenuExpanded ? ' toggled' : '' )"
	aria-expanded="false"
	[aria-expanded]="navMenuExpanded ? 'true' : 'false'"
>
	<?php the_custom_logo(); ?>
	<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id' => 'primary-menu',
				'container_class' => 'main-menu',
			)
		);
		?>
	<button
		id="menu-toggle"
		class="menu-toggle"
		on="tap:AMP.setState( { navMenuExpanded: ! navMenuExpanded } )"
		[class]="'menu-toggle' + ( navMenuExpanded ? ' toggled' : '' )"
		aria-controls="primary-menu"
		aria-expanded="false"
		[aria-expanded]="navMenuExpanded ? 'true' : 'false'"
	>
	<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'boyo' ); ?></span>
		<span class="hamburger-box">
			<span class="hamburger-bar-first"></span>
			<span class="hamburger-bar-second"></span>
			<span class="hamburger-bar-third"></span>
		</span>
	</button>
	<button
		id="search-toggle"
		class="search-toggle"
		on="tap:AMP.setState( { searchFormExpanded: ! searchFormExpanded } )"
		aria-controls="search-form-wrapper"
		aria-expanded="false"
		[aria-expanded]="searchFormExpanded ? 'true' : 'false'"
	>
		<span class="screen-reader-text"><?php esc_html_e( 'Search', 'boyo' ); ?></span>
		<span class="search-button"><svg version="1.1" id="search_icon" x="0px"
		y="0px" width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve">
			<path fill="#F05368" d="M17.545,16.684l-0.335,0.335l-0.813-0.813c1.246-1.42,2.009-3.275,2.009-5.309
		c0-4.446-3.616-8.063-8.06-8.063c-4.445,0-8.062,3.617-8.062,8.063c0,4.445,3.617,8.063,8.062,8.063
		c2.052,0,3.921-0.777,5.346-2.045l0.812,0.812l-0.372,0.372l7.013,7.012l1.414-1.414L17.545,16.684z M10.345,16.959
		c-3.343,0-6.062-2.72-6.062-6.063c0-3.343,2.719-6.063,6.062-6.063c3.341,0,6.06,2.72,6.06,6.063
		C16.405,14.239,13.687,16.959,10.345,16.959z"/>
		</svg></span>
	</button>
	<div
	id="search-form-wrapper"
	class="search-form-wrapper"
	[class]="'search-form-wrapper' + ( searchFormExpanded ? ' toggled' : '' )"
	aria-expanded="false"
	[aria-expanded]="searchFormExpanded ? 'true' : 'false'"
	>
		<?php get_search_form(); ?>
		<button
			id="search-close"
			class="search-close"
			on="tap:AMP.setState( { searchFormExpanded: ! searchFormExpanded } )"
			aria-controls="search-form-wrapper"
			aria-expanded="false"
			[aria-expanded]="searchFormExpanded ? 'true' : 'false'"
		>
			<span class="screen-reader-text"><?php esc_html_e( 'Search', 'boyo' ); ?></span>
			<span class="search-close-bars">
				<span class="search-close-bar-first"></span>
				<span class="search-close-bar-second"></span>
			</span>
		</button>
	</div>
</nav>
