<?php
header('Content-type: application/x-javascript');
define('WP_USE_THEMES', false);
require('../../../../wp-blog-header.php');
?>
function init() {
	myMap = new LMap();
    myMap.setContainer('<?php echo ( get_option('gmlp_divId') == "" ) ? "map" : get_option('gmlp_divId'); ?>');
	myMap.setLat(<?php echo floatval( get_option('gmlp_pinLat') )?>);
	myMap.setLng(<?php echo floatval( get_option('gmlp_pinLng') )?>);
<?php 
$zoom = intval( get_option('gmlp_zoom') );

if ( ($zoom > 0) && ($zoom < 21) ) {

?>
	myMap.setZoom('<?php echo $zoom ?>');
<?php } ?>


<?php if ( get_option('gmlp_pinInfoBox') == "yes" ) { ?>    
	myMap.setName('<?php echo get_option('gmlp_pinBoxName') ?>');
	myMap.setAddress('<?php echo strtr( get_option('gmlp_pinBoxDesc'), array("\n" => '<br />', "\r\n" =>'<br />')); ?>');
<?php } ?>
<?php if ( get_option('gmlp_mapShowOverview') == "no" ) { ?>    
	myMap.overview(false);
<?php } ?>
<?php if ( get_option('gmlp_mapShowType') == "no" ) { ?>    
	myMap.type(false);
<?php } ?>
	myMap.init();
<?php if ( get_option('gmlp_pinShowPin') == "yes" ) { 
		if ( get_option('gmlp_pinInfoBox') == "yes" ) {  ?>    
	myMap.showPin(true);
<?php } else { ?>    
	myMap.showPin(false);
<?php } 
} ?>
}
//Call the init function
window.onload = init;
//Destroy Google Maps objects on unload
window.onunload = GUnload; 