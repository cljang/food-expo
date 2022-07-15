<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Food_Expo
 */

get_header();
?>

<main id="primary" class="site-main">
	
	<?php
	if ( have_posts() ) :
		
		if ( is_home() && ! is_front_page() ) :
			get_template_part( 'template-parts/banner' );
		endif;
		?>

		<section class="blog-intro">
			<?php
			if ( function_exists('get_field') ) :
				if ( get_field('news_intro', 29) ) :
					?>
					<p><?php echo get_field('news_intro', 29) ?></p>
					<?php
				endif;
			endif;
			?>
		</section>
		
		<section>
			<div class = 'newsgrid'>
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_type() );
					
					
				endwhile;
				
				the_posts_navigation();
				
				?>
			</div>
			
		</section>
		<?php
		get_template_part('template-parts/featured-vendors');
	else :
		
		get_template_part( 'template-parts/content', 'none' );
		
	endif;

	?>
</main><!-- #main -->


<?php
get_footer();
