
<?php 
/**
 * dp1F functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage  dpcomet 
 * @since dpcomet  1.0
 */
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

// Theme Basic Function setup
add_action('after_setup_theme','dp1F_theme_functions');
function dp1F_theme_functions(){
    load_theme_textdomain('dp1F', get_template_directory_uri().'/lang');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-background');
    add_theme_support('post-formats',array(
       'video',
       'audio',
       'gallery',
       'quote',
       'slider'

    ));
}

// adding fonts 
function get_dp1F_fonts(){
    $fonts[]  = array();
    $fonts[]  = 'Montserrat:400,700';
    $fonts[]  = 'Raleway:300,400,500';
    $fonts[]  = 'Halant:300,400';
    $dp1F_fonts = add_query_arg( array(
         'family' => urldecode(implode('|', $fonts)),
         'subset' => 'latin',
    ),'https://fonts.googleapis.com/css');
    return $dp1F_fonts;
}     
//CSS Calling 
add_action ('wp_enqueue_scripts','theme_all_style');
function theme_all_style(){
  wp_enqueue_style('style', get_stylesheet_uri()); 
  wp_enqueue_style('style1', get_template_directory_uri().'/css/style.css'); 
  wp_enqueue_style('bundle', get_template_directory_uri().'/css/bundle.css');
  wp_enqueue_style('fonts', get_dp1F_fonts());
}


// script style Call 
function theme_jss_style(){
    wp_enqueue_script('html5shim','http://html5shim.googlecode.com/svn/trunk/html5.js',array(),'',false);
    wp_script_add_data('html5shim','conditional','if lt IE 9');
    
    wp_enqueue_script('maxcdn','https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js',array(),'',false);
    wp_script_add_data('maxcdn','conditional','if lt IE 9');
}
add_action('wp_enqueue_scripts' ,'theme_jss_style');


//Js style calling 
add_action('wp_enqueue_scripts','theme_all_js_style');
function theme_all_js_style(){
          wp_enqueue_script('jq', get_template_directory_uri().'/js/jquery.js');
          wp_enqueue_script('jsbundle', get_template_directory_uri().'/js/bundle.js',array('jq'),'',true);
          wp_enqueue_script('google-map','https://maps.googleapis.com/maps/api/js?v=3.exp',array('jq'),'',true);
          Wp_enqueue_script('main', get_template_directory_uri().'/js/main.js',array('jq','jsbundle'),'',true);
}

// Call gallery file
if(file_exists(dirname(__FILE__).'gallery.php')){
    require_once(dirname(__FILE__).'gallery.php');
}
