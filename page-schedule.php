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
        if( $query -> have_posts() ) :
          ?>
          <section class="events">
            <?php
            if( function_exists('get_field') ) :
              while( $query->have_posts() ) :
                  $query->the_post();
                  ?>
                  <article class="ife-event">
                    <?php the_post_thumbnail( 'ife-thumbnail') ?>
                    <h3 class="event-heading"><a href="<?php the_permalink(); ?> "><?php the_title() ?></a></h3>
                    <p class="event-time"><?php the_field('time'); ?></p>
                    <div class="event-description">
                      <p>
                        <?php 
                        $excerpt = "";
                        if( get_field('description') ) : 
                          $description_array = explode( " ", get_field('description') ); 
                          $excerpt_length = 30;
                          $excerpt_array = array_slice( $description_array, 0, $excerpt_length );
                          $excerpt = implode( " ", $excerpt_array );
                          
                          // Add "..." if description is longer than excerpt_length
                          if ( sizeof($description_array) > $excerpt_length ) :
                            $excerpt .= "...";
                          endif;
                        endif;
                        
                        // Output excerpt
                        echo $excerpt;
                        ?>
                        
                        <a class="read-more" href="<?php the_permalink() ?>">More Info<span class="screen-reader-text"> about <?php the_title() ?></span></a>
                      </p>
                    </div>
                  </article>
                  <?php
              endwhile;
            endif;
            ?>
          </section>
          <?php
          wp_reset_postdata();
        endif;
        
      get_template_part('template-parts/featured-vendors');

    endwhile; // End of the loop.
    ?>
        
  </main><!-- #primary -->
<?php
get_footer();
