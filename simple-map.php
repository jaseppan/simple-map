<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/*
Plugin Name: Simple Map
Plugin URI: http://jvseppanen.fi
Description: Simple map
Version: 1.0.0
Author: Janne Seppänen
Author URI: http://jvseppanen.fi
Text Domain: simple-map
Domain Path: /languages
License: GPL2
*/
/* Kartat */


function sm_map() {


	$address = "Veturitie 1, 87100 KAJAANI";
	ob_start(); ?>
	
	
			
			<style>.mapouter, iframe{text-align:right;height:300px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style>
					
			
				<div class="mapouter"><div class="gmap_canvas"><iframe id="gmap_canvas" src="https://maps.google.com/maps?q=<?php echo $address; ?>&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net"></a></div></div>
			

	<?php 
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
 
}

add_action('admin_menu', 'sm_admin_menu_page');

function sm_admin_menu_page() {
	add_menu_page( __('Simple Map'), __('Simple Map'), 'edit_posts', 'simple-map', 'sm_admin' , '', 10 );
}

add_shortcode('sm_map', 'sm_map');

function sm_admin() {
	
	$sm_map_address = get_option( '_sm_map_address', false );
	$sm_map_style = get_option( '_sm_map_style', false );

	?>
	<h1><?php _e('Simple Map') ?></h1>
	<form action="" method="post">
		<?php wp_nonce_field( 'sm-map', 'sm-map-nonce' ); ?>
		<input type="text" name="sm-map-address" value="<?php echo $sm_map_address ?>"><br />
		<input type="text" name="sm-map-style" value="<?php echo $sm_map_style ?>"><br />
		<input type="submit" value="<?php _e('Update') ?>">
	
	</form>
<?php }

function sm_save() {

	if(!current_user_can('edit_posts'))
		return;

}

add_action('init', 'sm_save');

?>
