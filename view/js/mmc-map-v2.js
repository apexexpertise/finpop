;(function($, window, document, undefined){
	var MfMapv2 = function( elem, options ){
		this.elem = elem;
		this.$elem = $(elem);
		this.options = options;
      	// <div class="item" data-plugin-options="{'message':'Goodbye World!'}"></div>
      	this.metadata = this.$elem.data( "plugin-options" );
    };

  	MfMapv2.prototype = {
  		defaults: {
  			type: 'projects',
  			projectLatLng: false,
  			params: {
  				tag: 'all',
  				status: 'gauged'
  			},
  			showInfoBox: true,
  			panControlOptions: {
  				position: google.maps.ControlPosition.TOP_LEFT
  			},
  			zoomControlOptions: {
  				position: google.maps.ControlPosition.TOP_LEFT
  			},
  			markerImage: 'https://www.tipeee.com/images/maps/map-cluster-01.png',
  			showButton: false,
  			mapCenter: new google.maps.LatLng(46.52863469527167,2.43896484375),
  			controlOverlay: true,
  			buttonId: null,
  			zoomLevel: 6,
  			mapStyles: [
	        	{
		        	"featureType": "road.arterial",
		        	"stylers": [
	            		{ "visibility": "simplified" },
	            		{ "color": "#cfcfdd" }
	          		]
	        	},{
	          		"featureType": "administrative.locality",
		          	"stylers": [
		            	{ "weight": 0.1 },
		            	{ "color": "#9992a0" }
		          	]
		        },{
		          	"featureType": "landscape.natural",
		          	"stylers": [
		            	{ "visibility": "simplified" },
		            	{ "color": "#f9f4e9" }
		          	]
		        },{
		          	"featureType": "poi.park",
		          	"stylers": [
		            	{ "visibility": "simplified" },
		            	{ "color": "#e2ecd7" }
		          	]
		        },{
		          	"featureType": "road.arterial",
		          	"stylers": [
		            	{ "color": "#c6c2c9" }
		          	]
		        },{
		          	"featureType": "road.highway",
		          	"stylers": [
		            	{ "weight": 0.4 },  
		            	{ "visibility": "simplified" }
		          	]
		        },{
		          	"featureType": "administrative.country",
		          	"elementType": "labels",
		          	"stylers": [
		            	{ "weight": 0.1 },
		            	{ "color": "#606d80" }
		          	]
		        }
	    	],
	    	clusterStyles: [
	    		{
			    	url: 'https://www.tipeee.com/images/maps/map-cluster-d.png',
					height: 40,
					width: 36,
					anchor: [6, 12],
					textColor: '#5aaa4b',
					textSize: 11
    			},{
					url: 'https://www.tipeee.com/images/maps/map-cluster-d.png',
					height: 40,
					width: 39,
					anchor: [5, 10],
					textColor: '#5aaa4b',
					textSize: 11
    			},{
					url: 'https://www.tipeee.com/images/maps/map-cluster-d.png',
					height: 40,
					width: 35,
					anchor: [5, 6],
					textColor: '#348724',
					textSize: 11
    			},{
					url: 'https://www.tipeee.com/images/maps/map-cluster-d.png',
					height: 40,
					width: 35,
					anchor: [5, 6],
					textColor: '#348724',
					textSize: 11
    			}
    		]
    	},
 
	    init: function() {
	      	this.config = $.extend( {}, this.defaults, this.options, this.metadata );
	 		
	 		this.config.mapOptions = {
		        zoom: this.config.zoomLevel,
		        center: this.config.mapCenter,
		        mapTypeId: google.maps.MapTypeId.ROADMAP,
		        styles: this.config.mapStyles,
		        streetViewControl: false,
		        mapTypeControl: false,
		        disableDefaultUI: this.config.disableDefaultUI,
		        scrollwheel: this.config.scrollwheel,
		        draggable: this.config.draggable,
		        zoomControlOptions: this.config.zoomControlOptions,
		        panControlOptions: this.config.panControlOptions

      		};

	      	this._buildMap();
	      	var self = this;
	      	if (this.config.type == 'projects') {
		      	this._getAddresses();
	      	}
	      	if (this.config.type == 'contributors') {
	      		for (var i = this.config.addresses.length - 1; i >= 0; i--) {
		      		self.addMarker(this.config.addresses[i]);
		      	};
		      	self._clusterizeMarkers();
		      	if (this.config.projectLatLng) {
			      	var myMarker = new google.maps.Marker({
	        			position: new google.maps.LatLng(this.config.projectLatLng.lat, this.config.projectLatLng.lng),
	        			map: self.map,
	        			icon: '/img/cursor.png',
	        			title: "Votre projet"
	      			});
      			}
	      	}

	      	return this;
	    },
	 
	    _buildMap: function() {
	      	this.map = new google.maps.Map(this.$elem[0], this.config.mapOptions);
	      	if (this.config.controlOverlay){
        		this._buildControlOverlay();
      		} else {
      			if (this.config.buttonId !== null) {
	      			var self = this;
	      			google.maps.event.addDomListener($(this.config.buttonId)[0], 'click', function() {
						self.localizeMe(self);
					});
				}
      		}
      		this.markers = [];
      		this.infosWindows = [];
	    },

	    _getAddresses: function() {
	    	var addressesUrl = Routing.generate('work.map.addresses', this.config.params);
	    	var self = this;
	    	$.getJSON(addressesUrl, function(addresses) {
	    		self.addresses = addresses;
	    		$('#project_number strong').text(self.addresses.length);
	    		$('#project_number').animate({
	    		 	opacity: '1'
	    		}, 300);
	      		for (var i = self.addresses.length - 1; i >= 0; i--) {
	      			if (self.addresses[i].latlng) {
	      				self.addMarker(self.addresses[i]);
	      			}
	      		};
	      		self._clusterizeMarkers();
	    	});
	    },

	    _buildControlOverlay: function() {
	    	var controlDiv = document.createElement('div');
	    	controlDiv.style.padding = '5px';

			var controlUI = document.createElement('div');
			controlUI.style.cursor = 'pointer';
			controlUI.style.textAlign = 'center';
			controlUI.style.margin = '20px 10px 0 0';
			controlUI.title = 'Trouver les projets près de chez moi';
			controlDiv.appendChild(controlUI);

			var controlText = document.createElement('a');
			controlText.setAttribute('class','overlay-localisation');
			controlText.innerHTML = '<i class="fa fa-location-arrow"></i> Trouver les projets près de chez moi';
			controlUI.appendChild(controlText);

			var self = this;
			google.maps.event.addDomListener(controlUI, 'click', function() {
				self.localizeMe(self);
			});
			controlDiv.index = 1;
      		this.map.controls[google.maps.ControlPosition.TOP_RIGHT].push(controlDiv);
	    },

	    localizeMe: function() {
	    	var self = this;
	    	if(navigator.geolocation) {
	    		navigator.geolocation.getCurrentPosition(function(position) {
	    			var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
					self.findClosestMarker(pos);
					var infowindow = new google.maps.InfoWindow({
						map: self.map,
						position: pos,
						content: 'Votre localisation a été calculée par votre navigateur.'
					});
          			self.map.setCenter(pos);
          			self.map.setZoom(10);
        		}, function() {
          			self.handleNoGeolocation(true);
    			});
      		} else {
        		self.handleNoGeolocation(false);
      		}
    	},

    	findClosestMarker: function(position) {
    		var lat = position.lat();
	        var lng = position.lng();
	        var R = 6371;
	        var distances = [];
	        var closest = -1;
	        for( i=0;i<this.markers.length; i++ ) {
	            var mlat = this.markers[i].position.lat();
	            var mlng = this.markers[i].position.lng();
	            var dLat  = this.rad(mlat - lat);
	            var dLong = this.rad(mlng - lng);
	            var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
	                Math.cos(this.rad(lat)) * Math.cos(this.rad(lat)) * Math.sin(dLong/2) * Math.sin(dLong/2);
	            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
	            var d = R * c;
	            distances[i] = d;
	            if ( closest == -1 || d < distances[closest] ) {
	                closest = i;
	            }
	        }
    	},

    	rad: function(x) {
      		return x*Math.PI/180;
    	},

	    addMarker: function(address, markerImage, showInfoBox) {
	    	var markerImage = markerImage || this.config.markerImage,
	    		showInfoBox = showInfoBox || this.config.showInfoBox,
	    		myLatlng 	= new google.maps.LatLng(address.latlng.lat,address.latlng.lng),
      			id 			= address.id,
      			title 		= address.title;

			for (i=0; i < this.markers.length; i++) {
				var existingMarker = this.markers[i];
				var pos = existingMarker.getPosition();
				if (myLatlng.equals(pos)) {
					var newLat = myLatlng.lat() + (Math.random() -.5) / 500;
					var newLng = myLatlng.lng() + (Math.random() -.5) / 500;
					myLatlng = new google.maps.LatLng(newLat,newLng);
				}
			}

			var marker = new google.maps.Marker({
				position: myLatlng,
				title: title,
				icon: {
					url: markerImage
				}
			});

			var contentString = '<div style="width: 315px;" class="clearfix">'+
		                        '<div style="float: left; width: 105px; height:75px;">'+
		                        '</div>'+
		                        '</div>';

		    if (showInfoBox){
        		var self = this;
        		google.maps.event.addListener(marker, 'click', function(){
          			self.showInfoWindow(marker, id);
        		});
      		}
			this.markers.push(marker);
	    },

	    showInfoWindow: function(marker, id){
	    	for (var i = this.infosWindows.length - 1; i >= 0; i--) {
        		this.infosWindows[i].close();
      		};
			this.infoWindow = new google.maps.InfoWindow();
			this.infoWindow.setContent(this.loadInfoWindowContent(id));
			this.infoWindow.open(this.map, marker);
			this.infosWindows.push(this.infoWindow);
	    },

	    loadInfoWindowContent: function(id) {
	    	var content = $.ajax({
        			url: Routing.generate('work.map.project', { 'workId': id }),
        			dataType:"html",
        			async: false
        		})
	    		.responseText;
      		return content;
	    },

	    _clusterizeMarkers: function(){
	    	var markerClusterer = new MarkerClusterer(this.map, this.markers, {
        		gridSize: 35,
        		maxZoom: 15,
        		calculator : function (markers, numStyles) {
          			var index = 0;
          			var title = "";
          			var count = markers.length;
          			if (count >= 5 && count < 10) {
            			index = 2;
          			}

          			if (count >= 10) {
            			index = 3;
          			}

          			return {
            			text: count,
            			index: index,
            			title: title
          			};
        		},
        		styles: this.config.clusterStyles
        	});
    	}
  	}
 
  	MfMapv2.defaults = MfMapv2.prototype.defaults;
 
	$.fn.mfMapv2 = function( options ) {
		return this.each(function() {
			new MfMapv2( this, options ).init();
		});
	};
 
})( jQuery, window , document);