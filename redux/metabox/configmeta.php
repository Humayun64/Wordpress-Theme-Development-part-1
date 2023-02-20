<?php 
 add_action('cmb2_admin_init','metabox_for_posts');
 function metabox_for_posts(){ 
    $metabox=new_cmb2_box(array(
        'id'           => 'additional-box',
        'object_types' => array('post'),
        'title'        => __('Additional Field','dp1F'),
    ));
    $metabox->add_field(array(
        'id'   => '_for-video',
        'type' => 'text',
        'name' => 'Video Url'
    ));
    $metabox->add_field(array(
        'id'   => '_for-gallery',
        'type' => 'text',
        'name' => 'Video Url'
    ));
    $metabox->add_field(array(
        'id'   => '_for-audio',
        'type' => 'text',
        'name' => 'Video Url'
    ));
    $metabox->add_field(array(
        'id'   => '_for-quote',
        'type' => 'text',
        'name' => 'Video Url'
    ));
 }
?> 