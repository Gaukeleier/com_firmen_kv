jQuery.noConflict();
// Umkreis Anzeigen um aktiven Bestatter
var map;
var markers = [];
var zoom = 15;
var size = 50;
var infoWindow;
var locationSelect;
var cityCircle;
var stylez = [
{
   featureType : "all", elementType : "all", stylers : [
   ]
}
];
jQuery(document).ready(function() {
	load();
	searchLocationsNear(new google.maps.LatLng(51, 6), 5000);
});
// Enter im Formular unterdrücken
jQuery('input').keydown(function(e)
{
   return e.keyCode !== 13;
});
function load()
{
   var lat = 51;
   var lng = 10;
   var zoom_start = 5;
   map = new google.maps.Map(document.getElementById("map"),
   {
      center : new google.maps.LatLng(lat, lng),
      zoom : zoom_start,
      mapTypeId : 'roadmap',
      streetViewControl : false,
	  zoomControl: true,
	  zoomControlOptions: {
    	style: google.maps.ZoomControlStyle.LARGE
  	  },
      mapTypeControl : true,
      mapTypeControlOptions :
      {
         style : google.maps.MapTypeControlStyle.DROPDOWN_MENU
      }
   });
  	// Instanz für Markerfenster starten
   infowindow = new google.maps.InfoWindow();
   locationSelect = document.getElementById("results_table");
};
function searchLocations()
{
   var address = document.getElementById("ort").value + " Deutschland";
   var geocoder = new google.maps.Geocoder();
   geocoder.geocode(
   {
      address : address
   }
   , function(results, status)
   {
      if (status == google.maps.GeocoderStatus.OK)
      {
		
         searchLocationsNear(results[0].geometry.location, 0);
      }
      else
      {
         alert('Die Stadt ' + address + ' wurde leider nicht gefunden. Bitte pruefen Sie die Eingabe!');
      }
   });
}
function clearLocations(radius, x)
{
   if (x == 0)
   {
      for (var i = 0; i < markers.length; i ++ )
      {
         markers[i].setMap(null);
      }
      markers.length = 0;
   }
   else
   {
      locationSelect = document.getElementById("results_table");
   }
   jQuery('.pagination').empty();
   locationSelect.innerHTML = "";
   var option = document.createElement("div");
   option.className = "warning-box";
   option.value = "none";
   if (radius == "Bundesweit")
   {
      option.innerHTML = "Ergebnisse Bundesweit";
   }
   else
   {
      option.innerHTML = "Ergebnisse im Umkreis von " + radius + " km";
   }
   locationSelect.appendChild(option);
}
// Suche der Marker in der DB ...  alle (1 = alle Marker anzeigen, 0 = nur die Marker im Suchbereich)
function searchLocationsNear(center, alle)
{
   // Kategorie der Joomla - Beiträge auslesen - im Inputfeld "map_cat"
   var map_cat = document.getElementById('map_cat').value;
   if (alle != 0) {map_cat = 0;}
   
   // Neue Kartengrenzen initialisieren
   var bounds = new google.maps.LatLngBounds();
   // Wenn alle = 0 dann radius sonst überregional suchen (sort 1 = distanz, 2 = datum)
   if (alle == 0)
   {
      var sort = 1;
      var radius = document.getElementById('bes_umkreissuche').value;
      clearLocations(radius, 0);
   }
   else
   {
      var sort = 2;
      var radius = alle;
      if (alle < 1000)
      {
         clearLocations(radius, 1);
      }
   }
   // JSON Url vorbereiten
   var searchUrl = '/components/com_firmen/views/firmens/js/map.php?lat='
   + center.lat() + '&lng=' + center.lng() + '&radius=' + radius + '&sort=' + sort + '&cat=' + map_cat;
   // Daten per JSON auslesen und in der Variablen "data" verarbeiten
   jQuery.getJSON(searchUrl, function(data)
   {
      var eintrag = '';
      if(data !== null && data.length !== 0)
      {
         jQuery.each(data, function(key, val)
         {
            var latlng = new google.maps.LatLng(val['breite'], val['laenge']);
            // Liste erstellen
            createOption(val, key , alle);			
            // Marker erstellen wenn innerhalb der sichtbaren karte
            createMarker(latlng, val, key);
            if (key === data.length - 1 || key === 1) {
				   // beim letzten Eintrag Maße der Karte aktualisieren
		           bounds.extend(latlng);
    		}
            // Einträge in der Liste anklickbar machen ... Marker auf der Karte öffnen sich
            $$('div.firmen-item').each(function(o)
            {
               $(o).addEvents(
               {
                  'click' : function(event)
                  {
                     var markerNum = $(o).id;
                     google.maps.event.trigger(markers[markerNum], 'click');
                  }
               });
            });
         });
      }
      if (alle != 5000)
      {
         // wenn suche nach Radius
         // Karte auf Maße anpassen
         map.fitBounds(bounds);
         var m = map.getCenter();
         // wenn nur ein Eintrag ist Zoom anpassen
         if(data !== null && data.length !== 0)
         {
            if(data.length == 1)
            {
               map.setZoom(15);
            }
         }
         else
         {
            // wenn kein Eintrag vorhanden ist
            var thisLatlng = new google.maps.LatLng(51, 10);
            map.setZoom(5);
            map.setCenter(thisLatlng);
            var option = document.createElement("div");
            option.innerHTML = "<h4>Leider kein Eintrag - Versuchen Sie einen gr&ouml;&szlig;eren Umkreis oder pr&uuml;fen Sie die Stadt!</h4>";
            locationSelect.appendChild(option);
         }
         // kreis entfernen
         if (cityCircle)
         {
            cityCircle.setMap(null);
         }
         var populationOptions =
         {
            strokeColor : "#E98500",
            strokeOpacity : 0.9,
            strokeWeight : 2, 
            fillColor : "#E98500",
            fillOpacity : 0.15,
            map : map,
            center : center,
            radius : radius * 1000
         };
      cityCircle = new google.maps.Circle(populationOptions);
		 
	  // Auf den neuen Kreis zentrieren
 	  map.fitBounds(cityCircle.getBounds());
	  
	  // Korrektur des Zentrierens +1 Zoomstufe
	  map.setZoom(map.getZoom()+1);
      }
      locationSelect.style.visibility = "visible";
   });
}
function createMarker(latlng, val, id)
{
   // MarkerContent vorbereiten
   var address = val['strasse']  + "<br>" + val['plz']  + " " + val['ort']
   var div_o = "<div onclick=\"location.href = '"  + val['id'] + "-" + val['alias'] + "'\" style=\"width : 180px; overflow : hidden; \"> ";
   var html = "<a class='firmen_liste_title' href='/"  + val['alias'] + "'>" +
   val['firma'] + "</a> <br/><div class='daten'>" +
   address + "</div>";
   var content = div_o + html + "</div>";
   // Marker erzeugen
   var marker = new google.maps.Marker(
   {
      map : map,
	  id: id,
	  optimized: false,
      position : latlng,
      content : content,
	  icon:  '/components/com_firmen/views/firmens/js/firma.png'
   });
   
   // Marker dem MarkerArray zufügen
   markers.push(marker);
   
 	// INFOBALLON zufügen
	google.maps.event.addListener(marker, 'click', function() {
		infowindow.setContent(this.content);
   		infowindow.open(map, this);
	    jQuery('#results_table').scrollTo("div#" + this.id, 800);
		});
   
   
}
function createOption(val, num, alle)
{
   var address = "<span itemprop='address' itemscope itemtype='http://data-vocabulary.org/Address'>" +
   "<span itemprop='street-address'>" + val['strasse'] + "</span>" + "<br><span itemprop='postal-code'>" +
   val['plz']  + "</span> <span itemprop='locality'>" + val['ort'] + "</span></span>";
   var option = document.createElement("div");
   if(alle == 0 && document.getElementById('bes_umkreissuche').value != "Bundesweit")
   {
      var distance = "<span>Entfernung: " + val['distance']  + " km von " + document.getElementById("ort").value + "</span></br>";
   }
   else
   {
      var distance = "";
   }
   if( val['tel']!=="" || val['tel'] !== undefined ) {var tel = "<i class='icon icon-phone'></i>" + val['tel'] + "<br>";}
   
   if( val['fax']!=="" || val['fax'] !== undefined) {var fax = "<i class='icon icon-print'></i>" + val['fax'] + "<br>";}
   if( val['mobil'] !== "" || val['mobil'] !== undefined) {var mobil = "<i class='icon icon-mobile-phone'></i>" + val['mobil'] + "<br>";}
     
   var html  = 	"<div  itemscope itemtype='http://schema.org/LocalBusiness' id='" + num + "' name='eintrag' class='firmen-item'><div class='col1'><div class='lead firmen_opt_title'> <a href='/"  + val['alias']  + 
   "' itemprop='name'>" +
   val['firma']  + "</span></a></div>" +
   address   + " </strong><br> " + 	distance + tel + fax + 
   val['email'] + "<br><a target='_blank' href='" +
   val['homepage'] + "'>" + val['homepage'] + "</a><div class='bes_details'></div></div>";
   jQuery('#results_table').append(html);
}
/**
 * Copyright (c) 2007-2012 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * @author Ariel Flesler
 * @version 1.4.3.1
 */
;(function($){var h=$.scrollTo=function(a,b,c){$(window).scrollTo(a,b,c)};h.defaults={axis:'xy',duration:parseFloat($.fn.jquery)>=1.3?0:1,limit:true};h.window=function(a){return $(window)._scrollable()};$.fn._scrollable=function(){return this.map(function(){var a=this,isWin=!a.nodeName||$.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!isWin)return a;var b=(a.contentWindow||a).document||a.ownerDocument||a;return/webkit/i.test(navigator.userAgent)||b.compatMode=='BackCompat'?b.body:b.documentElement})};$.fn.scrollTo=function(e,f,g){if(typeof f=='object'){g=f;f=0}if(typeof g=='function')g={onAfter:g};if(e=='max')e=9e9;g=$.extend({},h.defaults,g);f=f||g.duration;g.queue=g.queue&&g.axis.length>1;if(g.queue)f/=2;g.offset=both(g.offset);g.over=both(g.over);return this._scrollable().each(function(){if(e==null)return;var d=this,$elem=$(d),targ=e,toff,attr={},win=$elem.is('html,body');switch(typeof targ){case'number':case'string':if(/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(targ)){targ=both(targ);break}targ=$(targ,this);if(!targ.length)return;case'object':if(targ.is||targ.style)toff=(targ=$(targ)).offset()}$.each(g.axis.split(''),function(i,a){var b=a=='x'?'Left':'Top',pos=b.toLowerCase(),key='scroll'+b,old=d[key],max=h.max(d,a);if(toff){attr[key]=toff[pos]+(win?0:old-$elem.offset()[pos]);if(g.margin){attr[key]-=parseInt(targ.css('margin'+b))||0;attr[key]-=parseInt(targ.css('border'+b+'Width'))||0}attr[key]+=g.offset[pos]||0;if(g.over[pos])attr[key]+=targ[a=='x'?'width':'height']()*g.over[pos]}else{var c=targ[pos];attr[key]=c.slice&&c.slice(-1)=='%'?parseFloat(c)/100*max:c}if(g.limit&&/^\d+$/.test(attr[key]))attr[key]=attr[key]<=0?0:Math.min(attr[key],max);if(!i&&g.queue){if(old!=attr[key])animate(g.onAfterFirst);delete attr[key]}});animate(g.onAfter);function animate(a){$elem.animate(attr,f,g.easing,a&&function(){a.call(this,e,g)})}}).end()};h.max=function(a,b){var c=b=='x'?'Width':'Height',scroll='scroll'+c;if(!$(a).is('html,body'))return a[scroll]-$(a)[c.toLowerCase()]();var d='client'+c,html=a.ownerDocument.documentElement,body=a.ownerDocument.body;return Math.max(html[scroll],body[scroll])-Math.min(html[d],body[d])};function both(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);