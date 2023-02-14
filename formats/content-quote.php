        <article class="post-single">
            <div class="post-info">
                <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                <h6 class="upper"><span>By</span><a href="<?php the_author();?>"><?php the_author();?></a><span class="dot"></span><span><?php the_time('d F Y');?></span><span class="dot"></span><?php the_tags();?></h6>
            </div>
            
                <div class="post-body">
                <blockquote class="italic">
                 <?php echo wp_trim_words(get_the_content(),50,'');?>
                </blockquote>
            </div>
        </article>