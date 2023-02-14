    <article class="post-single">
              <div class="post-info">
                <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                <h6 class="upper"><span>By</span><a href="<?php the_author();?>"><?php the_author();?></a><span class="dot"></span><span><?php the_time('d F Y');?></span><span class="dot"></span><?php the_tags();?></h6>
              </div>
              <div class="post-media">
                <div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true" class="flexslider nav-outside">

                <ul class="slides">
                <?php 
                    $imagegula = get_post_meta(get_the_id(), '_for-gallery', true);
                    foreach($imagegula as $image): ?>
                    <li><img src="<?php echo $image; ?>" alt=""></li>
                <?php endforeach; ?>
                  </ul>
                     
                </div>
              </div>
              <div class="post-body">
                <?php the_content();?>
                <p><a href="<?php the_permalink();?>" class="btn btn-color btn-sm">Read More</a></p>
              </div>
    </article>   