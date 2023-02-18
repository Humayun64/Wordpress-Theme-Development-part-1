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
                    'post_type' => 'post'
              ));
            ?>
                <ul class="nav">
                <?php while($posts->have_posts()) : $posts->the_post(); ?>
                   <li><a href="#">Checklists for Startups<i class="ti-arrow-right"></i><span>30 Sep, 2015</span></a></li>
                <?php endwhile();?>
                </ul>
          <?php echo $args['after_widget'];?>
         <?php }

    //Form Method
         public function form($instant){ ?>
          <p>
            <label for="<?php echo $this->get_field_id('title');?>">Title:</label>
            <input type="text" name="<?php echo $this->get_field_name('title');?>" value="<?php echo $instant['title'];?>" id="<?php echo $this->get_field_id('title');?>" class="widefat" >
          </p>
        <?php }
 }
add_action('widgets_init','recnt_post_widget');
function recnt_post_widget(){
    register_widget('newp_recent_post');
}

?>