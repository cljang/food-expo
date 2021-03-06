<?php
/**
 * Template part for displaying featured vendors
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Food_Expo
 */

?>

<?php 

// Get the first ordered vendor type
// Vendors are returned based on a custom order set using the 'Category Order and Taxonomy Terms Order' Plugin
$terms = get_terms(array(
  'taxonomy' => 'ife-vendor-type',
  'number' =>		1,
));

if( $terms && !is_wp_error( $terms ) ) :
  $term = $terms[0];

  $args = array(
    'post_type' 	=> 'ife-vendor',
    'tax_query'		=> array(
      array(
        'taxonomy'	=> 'ife-vendor-type',
        'field'			=> 'slug',
        'terms'			=> $term->slug,
      )
    )
  );
  
  $query = new WP_Query( $args );
  
  if ( $query -> have_posts() ){
    ?>
    <section class="section-featured-vendors">
      <h2>Featured Vendors</h2>
      <div class="carousel">
        <button class="swiper-button-prev swiper-vendors-button-prev"></button>
        <div class="vendors swiper swiper-vendors">
          <div class="vendor-wrapper swiper-wrapper">
            <?php
            while ( $query -> have_posts() ) {
              $query -> the_post();
              ?>
              <div class="vendor swiper-slide">
                <?php the_post_thumbnail('ife-vendor-logo', ['class' => 'vendor-image']) ?>
              </div>
              <?php
        
            }
            wp_reset_postdata();
            ?>
          </div>
        </div>
        <button class="swiper-button-next swiper-vendors-button-next"></button>
        <nav class="swiper-pagination swiper-vendors-pagination"></nav>
      </div>
      <?php 
      if ( !is_page( 40 ) ) :
        ?>
        <a class="vendor-page-link" href="<?php echo esc_url( get_page_link( 40 ) ) ?>">
          See All Vendors
        </a>
        <?php
      endif
      ?>
    </section>
    <?php
  }
endif;