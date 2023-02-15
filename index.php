 <?php get_header()?>
    <section class="page-title parallax">
      <div data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri();?>/images/bg/18.jpg" class="parallax-bg"></div>
      <div class="parallax-overlay">
        <div class="centrize">
          <div class="v-center">
            <div class="container">
              <div class="title center">
                <h1 class="upper"><?php bloginfo('title');?><span class="red-dot"></span></h1>
                <h4><?php bloginfo('description');?></h4>
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
        <div class="col-md-3 col-md-offset-1">
          <div class="sidebar hidden-sm hidden-xs">
            <div class="widget">
              <h6 class="upper">Search blog</h6>
              <form>
                <input type="text" placeholder="Search.." class="form-control">
              </form>
            </div>
            <div class="widget">
              <h6 class="upper">Categories</h6>
              <ul class="nav">
                <li><a href="#">Fashion</a></li>
                <li><a href="#">Tech</a></li>
                <li><a href="#">Gaming</a></li>
                <li><a href="#">Food</a></li>
                <li><a href="#">Lifestyle</a></li>
                <li><a href="#">Money</a></li>
              </ul>
            </div>
            <div class="widget">
              <h6 class="upper">Popular Tags</h6>
              <div class="tags clearfix"><a href="#">Design</a><a href="#">Fashion</a><a href="#">Startups</a><a href="#">Tech</a><a href="#">Web</a><a href="#">Lifestyle</a></div>
            </div>
            <div class="widget">
              <h6 class="upper">Latest Posts</h6>
              <ul class="nav">
                <li><a href="#">Checklists for Startups<i class="ti-arrow-right"></i><span>30 Sep, 2015</span></a></li>
                <li><a href="#">The Death of Thought<i class="ti-arrow-right"></i><span>29 Sep, 2015</span></a></li>
                <li><a href="#">Give it five minutes<i class="ti-arrow-right"></i><span>24 Sep, 2015</span></a></li>
                <li><a href="#">Uber launches in Las Vegas<i class="ti-arrow-right"></i><span>20 Sep, 2015</span></a></li>
                <li><a href="#">Fun with Product Hunt<i class="ti-arrow-right"></i><span>16 Sep, 2015</span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php get_footer()?>