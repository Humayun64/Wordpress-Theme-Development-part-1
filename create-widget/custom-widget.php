<?php 
 class newp_recent_post extends WP_Widget{

    //construct method

         public function __construct(){
            parent::__construct('newp-recent-post','NewP Recnt Post',array(
                'description' => 'Custom latest post widget by NewP'
            ));
         }
    //widgets method
         public function widget($args,$instant){ ?>
           <?php echo $args['before_widget'];?>
            <?php echo $args['before_title'];?>Latest Posts<?php echo $args['after_title'];?>
            <?php 
              $posts = new WP_Query(array(
                    'post_type'       => 'post',
                    'posts_per_page' =>$instant['page'],
              ));
            ?>
                <ul class="nav">
                <?php while($posts->have_posts()) : $posts->the_post(); ?>

                   <li><a href="#"><?php the_title(); ?><i class="ti-arrow-right"></i><?php 
               if(!empty($instant ['date'])):?> <span>
                    <?php the_time('d M, Y');?></span><?php endif;?></a></li>

                <?php endwhile;?>
                <?php if(!empty($instant['show']) ): ?>
                   <p>show it</p>
                <?php endif;?>
                </ul>
          <?php echo $args['after_widget'];?>
         <?php }

    //Form Method
         public function form($instant){ ?>
          <p>
            <label for="<?php echo $this->get_field_id('title');?>">Title:</label>
            <input type="text" name="<?php echo $this->get_field_name('title');?>" value="<?php echo $instant['title'];?>" id="<?php echo $this->get_field_id('title');?>" class="widefat" >
          </p>
          <p>
			<label for="<?php echo $this->get_field_id('page')?>">Number of posts to show:</label>
			<input class="tiny-text" id="<?php echo $this->get_field_id('page')?>" name="<?php echo $this->get_field_name('page')?>" value="<?php echo $instant ['page'];?>" type="number" step="1" min="1" value="5" size="3">
          </p>

          <p>
			<input class="checkbox" type="checkbox" value="show" id="<?php echo $this->get_field_id('date');?>" name="<?php echo $this->get_field_name('date');?>" <?php 
               if(!empty($instant ['date'])){
                echo "checked ='checked'" ;
               }
            ?>>
			<label for="<?php echo $this->get_field_id('date');?>">Display post date?</label>
          </p>
        <?php }
 } 
add_action('widgets_init','recnt_post_widget');
function recnt_post_widget(){
    register_widget('newp_recent_post');
}

?>