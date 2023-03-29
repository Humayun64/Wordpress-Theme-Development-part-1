<?php get_header();?>
<section class="page-title parallax">
      <div data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri();?>/images/bg/23.jpg" class="parallax-bg"></div>
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
        <?php while(have_posts()) : the_post(); ?>
         <article class="post-single">
              <div class="post-info">
                <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                <h6 class="upper"><span>By</span><a href="<?php the_author();?>"><?php the_author();?></a><span class="dot"></span><span><?php the_time('d F Y');?></span><span class="dot"></span><?php the_tags();?></h6>
              </div>
              <div class="post-media"><a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a></div>
              <div class="post-body">
                <?php the_content();?>
              </div>
            </article>
          <?php endwhile;?>
          
         <?php 
            comments_template();
         ?>

        </div>
       <?php get_sidebar();?>
      </div>
    </section>
<?php get_footer();?>