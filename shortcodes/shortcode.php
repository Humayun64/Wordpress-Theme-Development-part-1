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
                  <h6>Most powerfull Item of this year<?php echo get_post_meta(get_the_id(),'_for-slider',true);?></h6>
                <p> 
                  <?php 
                     $first_button = get_post_meta(get_the_id(),'_first_button_text',true);
                     if(!empty($first_button) ) : 
                  ?>
                   <?php endif;?>

                    <a href="<?php the_permalink();?>" class="btn btn-light-out">Read More<?php echo $first_button?>
                    </a>
                   
                    <a href="<?php the_permalink();?>" class="btn btn-color btn-full">Services</a>
                </p>
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

    //about section shortcode 

    add_shortcode('home-about-section','home_about_section');
    function home_about_section($attr, $content = null){

      $attributes = extract(shortcode_atts(array(
        'title'    => 'Who We Are',
        'subtitle' => 'We are dirven by creative' 
      ),$attr) );
      ob_start(); ?>
         <section id="about">
            <div class="container">
              <div class="title center">
                <h4 class="upper"><?php echo $subtitle;?></h4>
                <h2><?php echo $title;?><span class="red-dot"></span></h2>
                <hr>
              </div>
              <div class="section-content">
                <div class="col-md-8 col-md-offset-2">
                  <p class="lead-text serif text-center"><?php echo $content;?></p>
                </div>
              </div>
            </div>
      </section>  
      <?php return ob_get_clean(); 
    }    
   

    //expertise section shortcode 
    add_shortcode('expertise-section', 'expertise_section');


    function expertise_section($attr, $content = null) {
    
    $attribute = extract(shortcode_atts(array(
    
      'title'     => 'Expertise',
      'subtitle'  => 'This is what we love to do.',
      'bgimage' => '',
      //first
      'first_front_icon' => 'focus',
      'first_back_icon' => 'focus',
      'first_title' => 'Branding',
      'first_content' => 'Facilis doloribus illum quis, expedita mollitia voluptate non iure, perspiciatis repellat eveniet volup.',
      //second 
      'second_front_icon' => 'focus',
      'second_back_icon' => 'focus',
      'second_title' => 'Interactive',
      'second_content' => 'Facilis doloribus illum quis, expedita mollitia voluptate non iure, perspiciatis repellat eveniet volup.',
      //third
      'third_front_icon' => 'focus',
      'third_back_icon' => 'focus',
      'third_title' => 'Production',
      'third_content' => 'Facilis doloribus illum quis, expedita mollitia voluptate non iure, perspiciatis repellat eveniet volup.',
      //last
      'last_front_icon' => 'focus',
      'last_back_icon' => 'focus',
      'last_title' => 'Editing',
      'last_content' => 'Facilis doloribus illum quis, expedita mollitia voluptate non iure, perspiciatis repellat eveniet volup.'
    
    ), $attr) );
    
      ob_start(); ?>
    
      <section class="p-0 b-0">
          <div class="col-md-6 col-sm-4 img-side img-left mb-0">
            <!-- <div class="img-holder"><img src="<?php echo $bgimage; ?>" alt="" class="bg-img"> -->
            <div class="img-holder"><img src="<?php echo $title; ?>" alt="" class="bg-img">
              <div class="centrize">
                <div class="v-center">
                  <div class="title txt-xs-center">
                    <h4 class="upper"><?php echo $subtitle; ?></h4>
                    <h3><?php echo $title;?><span class="red-dot"></span></h3>
                    <hr>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-md-offset-6 col-sm-8 col-sm-offset-4">
            <div class="row">
              <div class="services">
                <div class="col-sm-6 border-bottom border-right">
                  <div class="service"><i class="icon-<?php echo $first_front_icon; ?>"></i><span class="back-icon"><i class="icon-<?php echo $first_back_icon; ?>"></i></span>
                    <h4><?php echo $first_title; ?></h4>
                    <hr>
                    <p class="alt-paragraph"><?php echo $first_content; ?></p>
                  </div>
                </div>
                <div class="col-sm-6 border-bottom">
                  <div class="service"><i class="icon-<?php echo $second_front_icon; ?>"></i><span class="back-icon"><i class="icon-<?php echo $$second_back_icon; ?>"></i></span>
                    <h4><?php echo $second_title; ?></h4>
                    <hr>
                    <p class="alt-paragraph"><?php echo $second_content; ?></p>
                  </div>
                </div>
                <div class="col-sm-6 border-bottom border-right">           
                  <div class="service"><i class="icon-mobile"></i><span class="back-icon"><i class="icon-mobile"></i></span>
                    <h4>Production</h4>
                    <hr>
                    <p class="alt-paragraph">Doloribus qui asperiores nisi placeat volup eum, nemo est, praesentium fuga alias sit quis atque accus.</p>
                  </div>
                </div>
                <div class="col-sm-6 border-bottom">           
                  <div class="service"><i class="icon-globe"></i><span class="back-icon"><i class="icon-globe"></i></span>
                    <h4>Editing</h4>
                    <hr>
                    <p class="alt-paragraph">Aliquid repellat facilis quis. Sequi excepturi quis dolorem eligendi deleniti fuga rerum itaque.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
    
      <?php return ob_get_clean();
    }
  
  



 //The Vision shortcode 
 add_shortcode( 'the_vision', 'the_vision_shortcode' );

 function the_vision_shortcode( $atts, $content = null ) {
   $atts = extract(shortcode_atts( array(
       'title'       => 'The Vision',
       'subtitle'    => 'Not just code.',
       'visionimage' => ''
   ), $atts ));

   ob_start(); ?>

     <section>
           <div class="col-md-6 col-sm-4 img-side img-right">
             <div class="img-holder"><img src="<?php echo $visionimage;?>" alt="" class="bg-img"></div>
           </div>
           <div class="container">
             <div class="col-md-5 col-sm-8">
               <div class="title">
                 <h4 class="upper"><?php echo $subtitle;?></h4>
                 <h3><?php echo $title;?><span class="red-dot"></span></h3>
                 <hr>
               </div>
               <div class="col-md-6 col-sm-6">
                 <div class="row">
                   <div class="text-box">
                     <h4 class="upper small-heading">Strategy</h4>
                     <p>Natus totam adipisci illum aut nihil consequuntur ut, ducimus alias iusto facili.</p>
                   </div>
                 </div>
               </div>
               <div class="col-md-6 col-sm-6">
                 <div class="row">
                   <div class="text-box">
                     <h4 class="upper small-heading">Design</h4>
                     <p>Nisi, ut commodi dolor, quae doloremque earum alias accusantium sint.</p>
                   </div>
                 </div>
               </div>
               <div class="col-md-6 col-sm-6">
                 <div class="row">
                   <div class="text-box">
                     <h4 class="upper small-heading">Skills</h4>
                     <p>Nesciunt est eaque, expedita cum minima reprehenderit? Harum vero dolorum.</p>
                   </div>
                 </div>
               </div>
               <div class="col-md-6 col-sm-6">
                 <div class="row">
                   <div class="text-box">
                     <h4 class="upper small-heading">Power</h4>
                     <p>Fuga ipsum, repellendus? Architecto commodi magni non nihil et iusto.  </p>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </section>
   <?php return ob_get_clean(); 

}




//isotope 
add_shortcode('filter-isotope','dp1F_isotope_function');
function dp1F_isotope_function($atts,$content = null){
  $attributes = extract(shortcode_atts(array(
              'title' => 'Selected Works Here',           
  ),$atts));
  ob_start();?>
    <section id="portfolio" class="pb-0">
      <div class="container">
        <div class="col-md-6">
          <div class="title m-0 txt-xs-center txt-sm-center">
            <h2 class="upper"><?php echo $title;?><span class="red-dot"></span></h2>
            
            <hr>
          </div>
        </div>
        <div class="col-md-6">
          <ul id="filters" class="no-fix mt-25">
          <li data-filter="*" class="active">All</li>
                    <?php 
                         $terms = get_terms('comet-portfolio-category');
                         foreach($terms as $term) :
                     
                    ?>
            <li data-filter=".<?php echo $term->slug;?>"><?php echo $term->name;?></li>
            <?php endforeach;?>
          </ul>
        </div>
      </div>
      <div class="section-content pb-0">     
        <div id="works" class="four-col wide mt-50">
          <?php 
          $portfolio = new WP_Query(array(
            'post_type' => 'comet-portfolio'
          ));
          while($portfolio->have_posts()) : $portfolio->the_post();
          ?>
          

          <div class="work-item <?php 
                         $terms = get_the_terms(get_the_id(),'comet-portfolio-category');
                         foreach($terms as $term)
                         echo $term-> slug." ";
                        ?>">
            <div class="work-detail"><a href="<?php the_permalink();?>"><?php the_post_thumbnail();?>
                <div class="work-info">
                  <div class="centrize">
                    <div class="v-center">
                      <h3><?php the_title();?></h3>

                      <p>
                        <?php 
                         $terms = get_the_terms(get_the_id(),'comet-portfolio-category');
                         foreach($terms as $term)
                         echo $term-> name." ";
                        ?>
                        </p>
                    </div>
                  </div>
                </div></a></div>
          </div>
         <?php endwhile;?>
        </div>
      </div>
    </section>
  <?php return ob_get_clean();
}
?>