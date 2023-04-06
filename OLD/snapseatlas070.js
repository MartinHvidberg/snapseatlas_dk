// snapseatlas.js
// Author: Martin Hvidberg <martin@hvidberg.net>
var sa_name = "snapseatlas.js"
var sa_ver = "0.9.0"  // Just moved to NordicWay
var sa_build = "20230405.base"
var sa_nickname = "/Paaske_Lolland"
console.log("Start:", sa_name, "ver.", sa_ver, sa_nickname, sa_build);

// *** Set up the base map

	var inicenter = [55.00, 11.33];
	var inizoom = 12; // larger is closer
	var bbox = "8.0,54.0,15.0,58.0";  // Consider minimal init bbox, for better performance

	// Create all the tileLayer variables

		var osmm = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: "<a href='/html/credits.html'>Credits</a> | <a href='/html/index.html'>Snapse Atlas</a>"
							  });
		var esri = L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
			attribution: "<a href='/html/credits.html'>Credits</a>, <a href='/html/index.html'>Snapse Atlas</a>"
							  });

		var baseLayers = {
							"OSM, Mapnik" : osmm,
							"ESRI, images" : esri
						 };

	console.log("Done setting up the base-layers ... bbox=", bbox);


// *** Setup some plants layers ...

	// ** Define some map pins

	var ico_size = [20, 34]
	var ico_Anch = [10, 34] // half X size, full Y size.
	var pop_anch = [0, -25]

	// B
	var pinBred = L.icon({
	    iconUrl: './graphics/BenjaminKeen/red_MarkerB.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	var pinBbrown = L.icon({
	    iconUrl: './graphics/BenjaminKeen/brown_MarkerB.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	// E
	var pinEblue = L.icon({
	    iconUrl: './graphics/BenjaminKeen/blue_MarkerE.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	// G
	var pinGyellow = L.icon({
	    iconUrl: './graphics/BenjaminKeen/yellow_MarkerG.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	// H
	var pinHgreen = L.icon({
	    iconUrl: './graphics/BenjaminKeen/green_MarkerH.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	var pinHorange = L.icon({
	    iconUrl: './graphics/BenjaminKeen/orange_MarkerH.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	// K
	var pinKgreen = L.icon({
	    iconUrl: './graphics/BenjaminKeen/green_MarkerK.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	// L
	var pinLpurple = L.icon({
	    iconUrl: './graphics/BenjaminKeen/purple_MarkerL.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	//M
	var pinMlightblue = L.icon({
	    iconUrl: './graphics/BenjaminKeen/paleblue_MarkerM.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	// P
	var pinPgreen = L.icon({
	    iconUrl: './graphics/BenjaminKeen/green_MarkerP.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	var pinPyellow = L.icon({
	    iconUrl: './graphics/BenjaminKeen/yellow_MarkerP.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	// R
	var pinRgreen = L.icon({
	    iconUrl: './graphics/BenjaminKeen/green_MarkerR.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	var pinRpink = L.icon({
	    iconUrl: './graphics/BenjaminKeen/pink_MarkerR.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	var pinRyellow = L.icon({
	    iconUrl: './graphics/BenjaminKeen/yellow_MarkerR.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	// S
	var pinSpurp = L.icon({
	    iconUrl: './graphics/BenjaminKeen/purple_MarkerS.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	var pinSdarkgreen = L.icon({
	    iconUrl: './graphics/BenjaminKeen/darkgreen_MarkerS.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	// T
	var pinTyellow = L.icon({
	    iconUrl: './graphics/BenjaminKeen/yellow_MarkerT.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	var pinTgreen = L.icon({
	    iconUrl: './graphics/BenjaminKeen/green_MarkerT.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	// V
	var pinVpink = L.icon({
	    iconUrl: './graphics/BenjaminKeen/pink_MarkerV.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});
	// X
	var pinXpink = L.icon({
	    iconUrl: './graphics/BenjaminKeen/pink_MarkerX.png',
	    iconSize: ico_size, iconAnchor: ico_Anch, popupAnchor: pop_anch	});

	console.log("Done defining map pins ...");

	// ** Define a pop-up

	function popPlantenavn(agjfeature, layer) {
	    if (agjfeature.properties && agjfeature.properties.plantenavn) {
	    	var strLable = "<strong>" + agjfeature.properties.plantenavn + "</strong>"
	    	if (agjfeature.properties.uncertainty) {
	    		strLable += "<br>usikkerhed: " + agjfeature.properties.uncertainty + " meter"
	    	}
	    	if (agjfeature.properties.loctype) {
	    		strLable += "<br>naturtype: " + agjfeature.properties.loctype
	    	}
	    	if (agjfeature.properties.locname) {
	    		strLable += "<br>localitet: " + agjfeature.properties.locname
	    	}
	    	if (agjfeature.properties.date) {
	    		strLable += "<br>dato: " + agjfeature.properties.date
	    	}
	    	if (agjfeature.properties.source) {
	    		if (agjfeature.properties.source != 'GBIF.org') {
	    			strLable += "<br>kilde: " + agjfeature.properties.source
	    		}
	    	}
	        layer.bindPopup(strLable);
	    }
	}

	// ** Define some plant layers

	// Slaaen
	var layerSlaaen = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinSpurp});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Prunus spinosa';
	$.getJSON(urlbbox, function (datab) {layerSlaaen.addData(datab)});

	// Pors
	var layerPors = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinPgreen});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Myrica gale';
	$.getJSON(urlbbox, function (datab) {layerPors.addData(datab)});

	// Ene
	var layerEne = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinEblue});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Juniperus';
	$.getJSON(urlbbox, function (datab) {layerEne.addData(datab)});

	// Skovmærke
	var layerSkovm = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinSdarkgreen});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Galium odoratum';
	$.getJSON(urlbbox, function (datab) {layerSkovm.addData(datab)});

	// Kvan
	var layerKvan = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinKgreen});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Angelica';
	$.getJSON(urlbbox, function (datab) {layerKvan.addData(datab)});

	// Malurt
	var layerMalurt = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinMlightblue});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Seriphidium';
	$.getJSON(urlbbox, function (datab) {layerMalurt.addData(datab)});

	// Røllik
	var layerRoel = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinRpink});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Achillea';
	$.getJSON(urlbbox, function (datab) {layerRoel.addData(datab)});

	// Gul snerre
	var layerGSner = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinGyellow});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Galium verum';
	$.getJSON(urlbbox, function (datab) {layerGSner.addData(datab)});

	// Prikbladet perikon
	var layerPerikon = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinPyellow});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Hypericum';
	$.getJSON(urlbbox, function (datab) {layerPerikon.addData(datab)});

	// Rejnfan
	var layerRejn = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinRyellow});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Tanacetum';
	$.getJSON(urlbbox, function (datab) {layerRejn.addData(datab)});

	// Valnød
	var layerValnoed = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinVpink});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Juglans';
	$.getJSON(urlbbox, function (datab) {layerValnoed.addData(datab)});

	// Bær
	var layerBaerVaccinium = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinBbrown});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Vaccinium';
	$.getJSON(urlbbox, function (datab) {layerBaerVaccinium.addData(datab)});
	var layerBaerRubus = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinBred});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Rubus';
	$.getJSON(urlbbox, function (datab) {layerBaerRubus.addData(datab)});

	// Hedelyng
	var layerLyng = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinLpurple});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Calluna';
	$.getJSON(urlbbox, function (datab) {layerLyng.addData(datab)});

	// Tormentil
	var layerTormentil = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinTyellow});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Potentilla erecta';
	$.getJSON(urlbbox, function (datab) {layerTormentil.addData(datab)});

	// Revling
	var layerRevling = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinRgreen});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Empetrum nigrum';
	$.getJSON(urlbbox, function (datab) {layerRevling.addData(datab)});

	// Havtorn
	var layerHavtorn = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinHorange});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Hippopha';
	$.getJSON(urlbbox, function (datab) {layerHavtorn.addData(datab)});

	// Hassel
	var layerHassel = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinHgreen});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Corylus';
	$.getJSON(urlbbox, function (datab) {layerHassel.addData(datab)});

	// Timian
	var layerTimian = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinTgreen});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Thymus';
	$.getJSON(urlbbox, function (datab) {layerTimian.addData(datab)});

	//  // Rosa (pimpinellifolia L.)
	var layerRosa = L.geoJson(null,{
	    onEachFeature: popPlantenavn,
		pointToLayer: function (feature, latlng) {return L.marker(latlng, {icon: pinRpink});}
	});
	var urlbbox = 'php070/data.php?bbox='+bbox+'&species=Rosa';
	$.getJSON(urlbbox, function (datab) {layerRosa.addData(datab)});


	console.log("Done defining plan layers ...");


	// ** collect all the layers in a group :-)

	var overlayMaps = {
			"Bær (Vaccinium)": layerBaerVaccinium,
			"Bær (Rubus)": layerBaerRubus,
			"Ene": layerEne,
			"Gul snerre": layerGSner,
			"Hassel":layerHassel,
			"Havtorn":layerHavtorn,
			"Kvan": layerKvan,
			"Lyng": layerLyng,
			"Malurt": layerMalurt,
			"Pors": layerPors,
			"Prikbladet perikon": layerPerikon,
			"Rejnfan": layerRejn,
			"Revling": layerRevling,
			"Roser": layerRosa,
			"Røllik": layerRoel,
			"Skovmærke": layerSkovm,
			"Slåen": layerSlaaen,
			"Timian": layerTimian,
			"Tormentil": layerTormentil,
			"Valnød": layerValnoed};


// *** Preparing context menu

function showCoordinates (e) {
	alert(e.latlng);
}

function newOccurence (e) {
	var llat = (Math.round(100000.0*e.latlng.lat)/100000.0).toString();
	var llng = (Math.round(100000.0*e.latlng.lng)/100000.0).toString();
	var lurl = 'php070/NewOccurrenceForm.php?lat='+llat+'&lon='+llng;
	//alert(lurl);
	window.open(lurl,"_self");
}

function centerMap (e) {
	map.panTo(e.latlng);
}

function zoomIn (e) {
	map.zoomIn();
}

function zoomOut (e) {
	map.zoomOut();
}

// *** Put the 'map' together ...

	var map = L.map('map', {
					center: inicenter,
					zoom: inizoom,
					layers: [osmm],
					contextmenu: true,
	          contextmenuWidth: 130,
		      contextmenuItems: [ {
			      text: 'Ny plante her...',
			      callback: newOccurence
		      }, {
			      text: 'Vis koordinater',
			      callback: showCoordinates
		      },'-', {
			      text: 'Center map here',
			      callback: centerMap
		      }, {
			      text: 'Zoom in',
			      icon: 'graphics/zoom-in.png',
			      callback: zoomIn
		      }, {
			      text: 'Zoom out',
			      icon: 'graphics/zoom-out.png',
			      callback: zoomOut
		      }]
				});

	map.on('moveend', function (e) {
  	bbox = map.getBounds().toBBoxString();
		zoom = map.getZoom();
		console.log("moveend: ",bbox, "zoom: ", zoom);
	});

	layerSkovm.addTo(map); // also makes it default ON in layerControl ...

	var layerControl = L.control.layers(baseLayers, overlayMaps).addTo(map);

// Done...

	console.log("End:", sa_name); // Just for debugging ...
