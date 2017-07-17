//Define the map object that we will be using
function LMap() {

	this.lat = 0;				//Latitude of map's centre point
	this.lng = 0;				//Longitude of map's centre point
	this.container = "map";		//ID of div to contain the map object
	this.zoom = 14;				//Default zoom level
	this.name = "name";			//Compant name
	this.address = "Address goes here";//The text to show on the centre pin info window
	this.map;					//Google Maps Object
	this.loc;					//Centre point GLatLng object
	
	this.showOverview = true;	//Toggle the Overview pane on the map
	this.showType = true;		//Toggle the map type control
	
}

//Set the latitude for our map's centre point
LMap.prototype.setLat = function (lat) {
	this.lat = lat;	
};

//Set the longitude for our map's centre point
LMap.prototype.setLng = function (lng) {
	this.lng = lng;	
};

//Set the name of the containing div
LMap.prototype.setContainer = function (container) {
	this.container = container;	
};

//Set the initial zoom level
LMap.prototype.setZoom = function (zoom) {
	this.zoom = zoom;
};

//Set the info window text
LMap.prototype.setAddress = function (address) {
	this.address = address;
};

//Set the info window text
LMap.prototype.setZoom = function (zoom) {
	this.zoom = zoom;
};

LMap.prototype.setName = function (name) {
	this.name = name;
};

//Initialise the map, this will create the Google Map object and set the centre point
LMap.prototype.init = function () {

	if (GBrowserIsCompatible()) {
		
		// Create Map Object
		this.map = new GMap2(document.getElementById(this.container));

		this.map.addControl( new GSmallMapControl() );
		if (this.showOverview) 	this.map.addControl(new GOverviewMapControl());
		if (this.showType) 	this.map.addControl(new GMapTypeControl());

		//Create Lat/Lng pint to center map
		this.loc = new GLatLng( this.lat, this.lng );
		
		//Centre map and set zoom level
		this.map.setCenter( this.loc, this.zoom);
		
		//var marker = new GMarker( this.loc );
		//this.map.addOverlay(marker);
		
	}
	
};

//Set the display status of the overview control
LMap.prototype.overview = function (show) {

	if (show == true) {
		this.showOverview = true;
	} else {
		this.showOverview = false;
	}
	
};

//Set the display status of the overview control
LMap.prototype.type = function (show) {

	if (show == true) {
		this.showType = true;
	} else {
		this.showType = false;
	}
	
};

//Add the pin for the map's centre, this function takes a string input to be displayed in the info box
LMap.prototype.showPin = function (showInfoWindow) {

	//let's create a marker and add it to the map
	var marker = new GMarker( this.loc );
	this.map.addOverlay(marker);
	
	if ( showInfoWindow == true ) {
		//Open this info box with the HTML passed
		var html = '<strong>' + this.name + '</strong><br />'
					+ '<address>' + this.address + '</address>'
					+ '<form action="http://maps.google.com/maps" method="get" target="_blank">'
					+ '<strong>Get directions</strong>'
					+ '<br />From:&nbsp;<input type="text" class="inputbox" size="20" name="saddr" id="saddr" value="" />'
					+ '&nbsp;<input value="go" class="button" type="submit">'
					+ '<input type="hidden" name="daddr" value="' + this.lat + ', ' + this.lng + '" />'
					+ '</form>';
	
		marker.openInfoWindowHtml(html);
		
		//add the onclick handler for the marker
		GEvent.addListener( marker, 'click',
						   function() {
								marker.openInfoWindowHtml(html);
						   } );
		
	}

	
};

LMap.prototype.debug = function () {

	var message = 'Details for Map are\n'
				+ '\nLat: ' + this.lat
				+ '\nLng: ' + this.lng
				+ '\nContainer: ' + this.container
				+ '\nZoom: ' + this.zoom
				+ '\nMap: ' + this.map
				+ '\nLoc: ' + this.loc
				;
	
	alert(message);	
	
};