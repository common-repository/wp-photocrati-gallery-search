<?php
/**
Plugin Name: WP Photocrati Gallery Search
Description: Enables Search functionality for the images of Photocrati Image Gallery
Author: UpScaleThought
Version: 1.0
Author URI: http://www.upscalethought.com/
Plugin URI: http://www.upscalethought.com/products/
Text Domain: gen-wp-ngg-photocrati-search
Domain Path: /i18n/languages/
 
Copyright (C) 2015 UpScaleThought
@package NextGEN Gallery, Photocrati Gallery
**/

define('GEN_USTS_NGGS_PHOTOCRATI_PLUGIN_URL', plugins_url('',__FILE__));
define("GEN_USTS_PHOTOCRATI_BASE_URL", WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)));
define('GEN_USTS_NGGS_PHOTOCRATI_DIR', plugin_dir_path(__FILE__) );


$gen_usts_ngg_photoc_page = get_page_by_path('gen-photocrati-gallery-search');
$gen_usts_ngg_photoc_page_id = 0;
if($gen_usts_ngg_photoc_page){
	$gen_usts_ngg_photoc_page_id = $gen_usts_ngg_photoc_page->ID;
}
define('GEN_USTS_NGG_PHOTOCRATI_GALLERYSEARCH_PAGEID',$gen_usts_ngg_photoc_page_id);

include_once('includes/create_page.php');
include_once('includes/usts_ngg_init.php');
include_once('includes/search_ngg_image.php');

add_action('admin_menu', 'gen_nextgen_photocrati_plugin_admin_menu');
function gen_nextgen_photocrati_plugin_admin_menu(){
	add_object_page('WP Photocrati Gallery Search', 'WP Photocrati Gallery Search', 'publish_posts', 'custom_gallerysearch', 'gen_photocrati_search_settings_menu');
}
function gen_photocrati_search_settings_menu(){
  include_once('includes/photocrati_gallery_features.php');
}
function gen_photocrati_gallery_search_add_menu(){
  add_submenu_page( 'custom_gallerysearch', 'Pro Version', 'Pro Vesrion', 'manage_options', 'pro-version-menu', 'gen_pro_photocrati_version_settings');
}
function gen_pro_photocrati_version_settings(){
  include_once('includes/photocrati_gallerysearch_pro_version.php');
}
add_action('admin_menu','gen_photocrati_gallery_search_add_menu');
function gen_photocratigallerysearchjs_front(){
	wp_register_script( 'tosrusjs',plugins_url('/includes/tos_rus/src/js/jquery.tosrus.min.all.js',__FILE__));
	
	wp_enqueue_script( 'tosrusjs');
}

function gen_photocratigallerysearchcss_front(){
	wp_register_style( 'tosruscss',plugins_url('/includes/tos_rus/src/css/jquery.tosrus.all.css',__FILE__));
	wp_register_style( 'add_style_front_css',plugins_url('/assets/css/style.css',__FILE__));
	
	wp_enqueue_style( 'tosruscss');
    wp_enqueue_style( 'add_style_front_css');
	
}
add_action('wp_enqueue_scripts','gen_photocratigallerysearchjs_front');
add_action('wp_enqueue_scripts','gen_photocratigallerysearchcss_front');

register_activation_hook( __FILE__, 'gen_usts_ngg_photocrati_search_install' );
register_deactivation_hook( __FILE__, 'gen_usts_ngg_photocrati_search_uninstall' );

