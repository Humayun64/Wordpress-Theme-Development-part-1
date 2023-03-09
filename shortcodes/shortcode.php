<?php 
add_shortcode('home-slide','newp_custom_slider');
function newp_custom_slider(){
    ob_start(); ?>
    <section id="home">
      <div id="home-slider" class="flexslider">
        <ul class="slides">
            <?php
             $slider = new WP_Query(array(
                'post_type'      => 'dp1F-slider',
                'posts_per_page' => 3,

             ));
             while( $slider->have_posts()) : $slider->the_post();
            ?>
          <li><?php the_post_thumbnail(); ?>
            <div class="slide-wrap">
              <div class="slide-content">
                <div class="container">
                  <h1><?php the_title();?><span class="red-dot"></span></h1>
                  <h6><?php echo get_post_meta(get_the_id(),'_for-slider',true);?></h6>
                  <p><a href="<?php the_permalink();?>" class="btn btn-light-out">Read More</a><a href="<?php the_permalink();?>" class="btn btn-color btn-full">Services</a></p>
                </div>
              </div>
            </div>
          </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </section>

    <?php return ob_get_clean(); 
    }
?>