<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Food_Expo
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'food-expo' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="header-content">
			<div class="site-branding">
				<?php
				function get_site_title () {
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$logo = wp_get_attachment_image_src( $custom_logo_id , 'thumbnail' );
					if ( has_custom_logo() ) :
						?>
						<img class="site-logo" src=<?php echo esc_url( $logo[0] ) ?> alt=<?php echo get_bloginfo( 'name' ) ?> >
						<span class="screen-reader-text"><?php bloginfo( 'name' ) ?></span>
						<?php
					else :
						bloginfo( 'name' );
					endif;
				}
				if ( is_front_page() ) :
					?>
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php
							get_site_title();
							?>
						</a>
					</h1>
					<?php
				else :
					?>
					<p class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php
							get_site_title();
							?>
						</a>
					</p>
					<?php
				endif;
				$food_expo_description = get_bloginfo( 'description', 'display' );
				if ( $food_expo_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $food_expo_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->
			<button class="menu-toggle-button" aria-controls="primary-menu" aria-expanded="false" aria-label="Navigation Menu">
				<div class="bar bar-1"></div>
				<div class="bar bar-2"></div>
				<div class="bar bar-3"></div>
			</button>
			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->
			<a class="buy-tickets-link" href=<?php echo get_permalink(44) ?>>
				Buy Tickets
			</a>

		</div>
	</header><!-- #masthead -->
