<?php 
function gen_usts_photocrati_gallery_image_search($atts){
	global $table_prefix,$wpdb;
	$tag = "";
	$sql_ngg_pictures = "";
	if(isset($_REQUEST['tag'])){
		$tag = $_REQUEST['tag'];
		$sql_ngg_pictures = "select pcg.id as pcgid,pcg.*,pcgid.* from ".$table_prefix."photocrati_galleries pcg
							inner join ".$table_prefix."photocrati_gallery_ids pcgid on pcgid.post_id = pcg.post_id
							where pcgid.gal_title like '%". $tag ."%'";														
	}
	if($_POST){
		if(isset($_REQUEST['txtnggSearchtag'])){
		   $tag = $_REQUEST['txtnggSearchtag'];
		}
		$sql_ngg_pictures = "select pcg.id as pcgid,pcg.*,pcgid.* from  ".$table_prefix."photocrati_galleries pcg
							inner join ".$table_prefix."photocrati_gallery_ids pcgid on pcgid.post_id = pcg.post_id
							where pcgid.gal_title like '%". $tag ."%'";					
	}
	//die($sql_ngg_pictures);
	$pictures = $wpdb->get_results($sql_ngg_pictures);
	//die(print_r($pictures));
	$output .= '<script type="text/javascript" language="javascript">
    			 jQuery(function( jQuery ) {
				 	jQuery("#wpngg_img_search_result a").tosrus({
						buttons: "inline",
						caption    : {
						  add        : true
					    },
						pagination	: {
							add			: true,
							type		: "thumbnails"
						}
					 });
				 });
				 /*jQuery(".fancybox")
					.attr("rel", "gallery")
					.fancybox({
						openEffect  : "none",
						closeEffect : "none",
						nextEffect  : "none",
						prevEffect  : "none",
						padding     : 0,
						margin      : [20, 60, 20, 60] // Increase left/right margin
					});*/
    			</script>
	<div id="ngg_picture_gallery">';
	$output .= '<form id="frmgallerysearch" action="'.get_option("siteurl").'/?page_id='.GEN_USTS_NGG_PHOTOCRATI_GALLERYSEARCH_PAGEID.'" method="post">
				  <!-- <input type="text" id="txtnggSearchtag" name="txtnggSearchtag" value="" style="height:30px" />
				   <input type="submit" id="btnnggsearch" name="btnnggsearch" value="Image Search" style="width:115px;height:40px;" placeholder="Search Gallery Image" />-->
				</form>';
	$output .= '<div id="wpngg_img_search_result" class="thumbs">
				  <div style="float:left;"> 
					';
	$shown = array();				
	if(count($pictures)>0){				
		foreach($pictures as $picture){
		     //die(print_r($picture));
			if( in_array($picture->image_name, $shown) ) {
				continue;
			}
			$shown[] = $picture->image_name;
			$upload_dir = wp_upload_dir();
			
			$output .= '<div style="float:left;border:solid 1px #CCCCCC;margin:7px;">
							<a id="addto_178" class="iframe" href="'.$upload_dir['baseurl'].'/galleries/post-'.$picture->post_id.'/full/'.$picture->image_name.'" title="'.$picture->image_alt.'">
								<img class="" src="'.$upload_dir['baseurl'].'/galleries/post-'.$picture->post_id.'/full/'.$picture->image_name.'" style="" /> 
							</a>
							
						</div>';
		}
	}
	$output .= '</div>
			</div>';
	$output .= '</div>';
	return $output;
	
}	
add_shortcode('gen-usts-photocrati-gallery-search','gen_usts_photocrati_gallery_image_search');

function gen_usts_photocrati_gallery_image_search_box(){
	if($_POST){
		$box_tag = "";
		if(isset($_REQUEST['btnnggsearch_box'])){
			$box_tag = $_REQUEST['txtnggSearchtag_box'];	
		} 
		wp_redirect( get_option("siteurl").'/?page_id='.GEN_USTS_NGG_PHOTOCRATI_GALLERYSEARCH_PAGEID.'&tag='.$box_tag); exit; 
	}	
	$output_box = '<form id="frmgallerysearch_box" action="'.get_option("siteurl").'/?page_id='.GEN_USTS_NGG_PHOTOCRATI_GALLERYSEARCH_PAGEID.'" method="post">
				   <input type="text" id="txtnggSearchtag_box" name="txtnggSearchtag_box" value="" style="height:30px" />
				   <input type="submit" id="btnnggsearch_box" name="btnnggsearch_box" value="Gallery Search" style="width:115px;height:40px;" placeholder="Search Gallery Image" />
				   <input type="hidden" value="fromwidget" name="from_widget" id="from_widget"/>
				</form>';
	return $output_box;			
}

add_shortcode('gen-usts-photocrati-gallery-search-box','gen_usts_photocrati_gallery_image_search_box');