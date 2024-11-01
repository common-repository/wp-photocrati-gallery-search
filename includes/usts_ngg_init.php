<?php
function gen_usts_ngg_photocrati_search_install() {
   global $table_prefix, $wpdb;
   //Page creation for Shopping Cart and Checkout Page
   $gen_usts_ngg_page_id = gen_usts_photocrati_programmatically_create_page('Gen Photocrati Gallery Search','gen-photocrati-gallery-search','[gen-usts-photocrati-gallery-search-box][gen-usts-photocrati-gallery-search]','page');
	 
	 
}
function gen_usts_ngg_photocrati_search_uninstall(){
	wp_delete_post(GEN_USTS_NGG_PHOTOCRATI_GALLERYSEARCH_PAGEID,1);
}