 <?php get_header()?>
    <section class="page-title parallax">
      <div data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri();?>/images/bg/18.jpg" class="parallax-bg"></div>
      <div class="parallax-overlay">
        <div class="centrize">
          <div class="v-center">
            <div class="container">
              <div class="title center">
                <h1 class="upper"><?php global $dp1F; echo $dp1F['blog-title'];?><span class="red-dot"></span></h1>
                <h4><?php global $dp1F; echo $dp1F['blog-subtitle'];?></h4>
                <hr>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
        <div class="col-md-8">
          <div class="blog-posts">
         <?php 
            while(have_posts() ): the_post();?>
                <?php get_template_part('formats/content',get_post_format());?>
            <?php endwhile;?>
          </div>
          <?php 
          if(function_exists('the_posts_pagination')) {
            the_posts_pagination(array(
                'prev_text' => '<span aria-hidden="true"><i class="ti-arrow-left"></i></span>',
                'next_text' => '<span aria-hidden="true"><i class="ti-arrow-right"></i></span>',
                'screen_reader_text' => ' '
              )); 
          }
          ?>

         
        </div>
        <?php get_sidebar();?>
    </section>
  <?php get_footer()?>