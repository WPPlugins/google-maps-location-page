<?php
if ( $_REQUEST['action'] == 'update' ) {

update_option('gmlp_gApiKey', $_REQUEST['gApiKey']);
update_option('gmlp_divWidth', $_REQUEST['divWidth']);
update_option('gmlp_divHeight', $_REQUEST['divHeight']);
update_option('gmlp_divId', $_REQUEST['divId']);
update_option('gmlp_divClass', $_REQUEST['divClass']);
update_option('gmlp_pinLat', $_REQUEST['pinLat']);
update_option('gmlp_pinLng', $_REQUEST['pinLng']);
$zoom = intval( $_REQUEST['zoom'] );
update_option('gmlp_zoom', ( ( ( $zoom > 0 ) && ( $zoom < 21 ) ) ? $zoom : 14 ) );
update_option('gmlp_pinShowPin', $_REQUEST['pinShowPin']);
update_option('gmlp_pinInfoBox', $_REQUEST['pinInfoBox']);
update_option('gmlp_pinBoxName', $_REQUEST['pinBoxName']);
update_option('gmlp_pinBoxDesc', $_REQUEST['pinBoxDesc']);
update_option('gmlp_mapShowOverview', $_REQUEST['mapShowOverview']);
update_option('gmlp_mapShowType', $_REQUEST['mapShowType']);

}



?>

<div class="wrap">
<div id="icon-options-general" class="icon32">
<br/>
</div>
<h2>Location Page Options</h2>
<p>Set the options below to configure your map.</p>
</div>
<form method="post" action="">
<?php settings_fields( 'gmlp-option-group' ); ?>
<table class="form-table">
<tr><td><label for="gApiKey">Google Maps API Key</label></td>
<td><input type="text" id="gApiKey" name="gApiKey" class="regular-text code" value="<?php echo get_option('gmlp_gApiKey'); ?>" /> <span class="description">No API key?  Get one <a href="http://code.google.com/apis/maps/signup.html" target="_blank">here</a></span></td></tr>
<tr><td colspan="2"><h3>Map DIV Options</h3></td></tr>
<tr><td><label for="divWidth">Width</label></td>
<td><input type="text" id="divWidth" name="divWidth" class="small-text code" value="<?php echo get_option('gmlp_divWidth'); ?>" /> <span class="description">Leave blank to use CSS values.</span></td></tr>
<tr><td><label for="divHeight">Height</label></td>
<td><input type="text" id="divHeight" name="divHeight" class="small-text code" value="<?php echo get_option('gmlp_divHeight'); ?>" /> <span class="description">Leave blank to use CSS values.</span></td></tr>
<tr><td><label for="divId">ID</label></td>
<td><input type="text" id="divId" name="divId" class="regular-text code" value="<?php echo get_option('gmlp_divId'); ?>" /> <span class="description">if blank default of <code>map</code> will be used.</span></td></tr>
<tr><td><label for="divClass">Class</label></td>
<td><input type="text" id="divClass" name="divClass" class="regular-text code" value="<?php echo get_option('gmlp_divClass'); ?>" /> <span class="description">if blank default of <code>map</code> will be used.</span></td></tr>
<tr><td colspan="2"><h3>Pin Options</h3></td></tr>
<tr><td><label for="pinLat">Latitude</label></td>
<td><input type="text" id="pinLat" name="pinLat" class="regular-text code" value="<?php echo get_option('gmlp_pinLat'); ?>" /></td></tr>
<tr><td><label for="pinLng">Longitude</label></td>
<td><input type="text" id="pinLng" name="pinLng" class="regular-text code" value="<?php echo get_option('gmlp_pinLng'); ?>" /></td></tr>
<tr><td>Show Pin</td>
<td><input type="radio" name="pinShowPin" value="yes"<?php echo ( get_option('gmlp_pinShowPin') != "no" ) ? ' checked="checked"' : "" ?> /> Yes<br />
<input type="radio" name="pinShowPin" value="no"<?php echo ( get_option('gmlp_pinShowPin') == "no" ) ? ' checked="checked"' : "" ?> /> No</td></tr>
<tr><td>Show Info Box</td>
<td><input type="radio" name="pinInfoBox" value="yes"<?php echo ( get_option('gmlp_pinInfoBox') != "no" ) ? ' checked="checked"' : "" ?> /> Yes<br />
<input type="radio" name="pinInfoBox" value="no"<?php echo ( get_option('gmlp_pinInfoBox') == "no" ) ? ' checked="checked"' : "" ?> /> No</td></tr>
<tr><td><label for="pinBoxName">Info Box Name</label></td>
<td><input type="text" id="pinBoxName" name="pinBoxName" class="regular-text code" value="<?php echo get_option('gmlp_pinBoxName'); ?>" /></td></tr>
<tr><td><label for="pinBoxDesc">Info Box Desription</label></td>
<td><textarea id="pinBoxDesc" name="pinBoxDesc" class="code" cols="50" rows="5"><?php echo get_option('gmlp_pinBoxDesc'); ?></textarea></td></tr>
<tr><td colspan="2"><h3>Map Features</h3></td></tr>
<tr><td><label for="pinLng">Zoom Level</label></td>
<td><input type="text" id="zoom" name="zoom" class="regular-text code" value="<?php echo get_option('gmlp_zoom'); ?>" /></td></tr>
<tr><td>Show Overview</td>
<td><input type="radio" name="mapShowOverview" value="yes"<?php echo ( get_option('gmlp_mapShowOverview') == "yes" ) ? ' checked="checked"' : "" ?> /> Yes<br />
<input type="radio" name="mapShowOverview" value="no"<?php echo ( get_option('gmlp_mapShowOverview') != "yes" ) ? ' checked="checked"' : "" ?> /> No</td></tr>
<tr><td>Show Type</td>
<td><input type="radio" name="mapShowType" value="yes"<?php echo ( get_option('gmlp_mapShowType') == "yes" ) ? ' checked="checked"' : "" ?> /> Yes<br />
<input type="radio" name="mapShowType" value="no"<?php echo ( get_option('gmlp_mapShowType') != "yes" ) ? ' checked="checked"' : "" ?> /> No</td></tr>
</table>
<p class="submit">
<input class="button-primary" type="submit" value="Save Changes" name="submit" />
</p>
</form>
<h3>Map Preview</h3>
<?php 
if ( get_option('gmlp_gApiKey') != "" ) {

	echo gmlp_show_map( true );

} else { ?>
<p>Map Preview not available until API key is set</p>
<?php } ?>