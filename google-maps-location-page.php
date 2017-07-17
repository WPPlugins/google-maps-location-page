<?php
/*
Plugin Name: Google Maps Location Page
Plugin URI: http://www.proactivewebdesign.co.uk/wordpress/google-maps-location-page/
Description: Add a Google Maps based location page to you WP site.
Version: 1.0.5
Author: Pro@ctive Web Design
Author URI: http://www.proactivewebdesign.co.uk/
*/
?>
<?php
/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
//Add action for admin menu
add_action('admin_menu', 'gmlp_admin_menu');
add_shortcode('gmlp-show-map','gmlp_show_map');

function gmlp_admin_menu() {

	$mypage = add_options_page('Location Page Options','Location Page', 8, "gmlpadminoptions", "gmlp_admin_options");
	add_action( "admin_print_scripts-$mypage", 'gmlp_load_scripts' );

}

function gmlp_admin_options() {

	require_once( dirname( __FILE__ ). "/php/admin_options.php" );

}

function gmlp_load_scripts( $noQueue = false ) {

	$plugindir = get_settings('home') . '/wp-content/plugins/' . dirname( plugin_basename(__FILE__) );
	$urlGoogleMaps = 'http://maps.google.com/maps?file=api&amp;v=2&amp;key=' . get_option('gmlp_gApiKey');
	$urlGmlpMapsLib = $plugindir . '/js/gMapsLib.js';
	$urlGmlpInit = $plugindir . '/js/location.js.php';
	
	if ( $noQueue ) {
	
		$scripts = <<<END_SCRIPTS
<script type="text/javascript" src="$urlGoogleMaps"></script>
<script type="text/javascript" src="$urlGmlpMapsLib"></script>
<script type="text/javascript" src="$urlGmlpInit"></script>
END_SCRIPTS;

		return $scripts;
	
	} else {
	
		wp_enqueue_script('googleMaps', $urlGoogleMaps );
		wp_enqueue_script('gmlpMapsLib', $urlGmlpMapsLib );
		wp_enqueue_script('gmlpInit', $urlGmlpInit );

	}
	
	return null;

}

function gmlp_show_map( $noScripts = false ) {

	$divHeight = get_option('gmlp_divHeight');
	$divWidth = get_option('gmlp_divWidth');
	
	$divStyle = "";
	
	if ( intval( $divWidth ) > 0 ) {
	
		$divStyle .= "width:" . intval( $divWidth ) . "px;";
	
	}
	
	if ( intval( $divHeight ) > 0 ) {
	
		$divStyle .= "height:" . intval( $divHeight ) . "px;";
	
	}
	
	if ( $divStyle != "" ) {
	
		$divStyle = ' style="' . $divStyle . '"';
	
	}
	
	
	$divId = get_option('gmlp_divId');
	$divId = ( $divId == "" ) ? "map" : $divId;
	$divClass = get_option('gmlp_divClass');
	$divClass = ( $divClass == "" ) ? "map" : $divClass;
    
    if ( $noScripts == false ) {
    
    	$result = gmlp_load_scripts(true);
    
    }

	$result .= <<<END_MAP
<div id="$divId" class="$divClass"$divStyle></div>
END_MAP;

	return $result;
}


?>