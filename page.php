<?php get_header();?>
<section class="page-title parallax">
      <div data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri();?>/images/bg/18.jpg" class="parallax-bg"></div>
      <div class="parallax-overlay">
        <div class="centrize">
          <div class="v-center">
            <div class="container">
              <div class="title center">
                <h1 class="upper"><?php wp_title('');?><span class="red-dot"></span></h1>
                <h4><?php global $dp1F; echo $dp1F['blog-subtitle'];?></h4>
                <hr>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
 <?php while(have_posts()) : the_post();?>
   <?php the_content();?>
 <?php endwhile?>
<?php get_footer();?>