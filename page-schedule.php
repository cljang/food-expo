<?php
/**
 * The template for displaying schedule page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */
get_header();
?>
    <main id="primary" class="site-main">
        <?php
		while ( have_posts() ) :
			the_post();

			get_template_part('template-parts/banner');

            $args = array(
                'post_type'     =>'ife-event',
                'posts_per_page' => -1,
                'meta_key'	=> 'time',
                'orderby'   => 'meta_value',
                'order'     => 'asc'
            );

            $query = new WP_Query( $args );
            if( $query -> have_posts() ) {
                echo '<section class="events">';
                while(  $query->have_posts() ) {
                    $query->the_post();
                    ?>
                    <article class="ife-events">
                        <h2 class="event-heading"><a href="<?php the_permalink(); ?> "><?php the_title() ?></a></h2>
                        <p class="event-time"><?php the_field('time'); ?></p>
                        <?php the_post_thumbnail( 'day-1-pass') ?>
                        <div class="event-description">
                            <?php the_field('description'); ?>
                        </div>
                        <a href="<?php the_permalink(); ?> ">More Info</a>
                        <div class="event-type">
                            <?php 
                            $currentID = get_the_ID();
                            echo get_the_term_list( get_the_ID(), 'ife-event-type');
                            ?>
                        </div>
                    </article>
                    <?php
                }
                echo '</section>';
                wp_reset_postdata();
            };
            ?>
        <?php 
        
        get_template_part('template-parts/featured-vendors');

		endwhile; // End of the loop.
		?>
          
    </main><!-- #primary -->
<?php
get_footer();
