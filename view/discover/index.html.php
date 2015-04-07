<?php
/*
 * Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
 * This file is part of Goteo.
 *
 * Goteo is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Goteo is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Goteo. If not, see <http://www.gnu.org/licenses/agpl.txt>.
 *
 */
use Goteo\Core\View, Goteo\Library\Text;

$bodyClass = 'discover';
include 'view/prologue.html.php';
include 'view/header.html.php'?>
<div id="sub-header">
	<div>
		<h2><?php echo Text::html('discover-banner-header') ?></h2>
	</div>
</div>
<div class="container" id="projects-area">
	<div class="row clearfix">
		<div class="col-md-12 column" >
			<div class="row clearfix">
				<div class="col-md-2 column">
				        <?php
												
												echo new View ( 'view/discover/searcher.html.php', array (
														'categories' => $categories,
														'locations' => $locations,
														'rewards' => $rewards 
												) );
												?>
				</div>
				<div class="col-md-10 column box-border-left">
				    <?php
				
	foreach ( $this ['lists'] as $type => $list ) :
					
					if (array_empty ( $list ))
						continue;
					?>
					
					<div class="widget projects">
						<h2 class="title"><i class="fa fa-yelp fa-1x" style="color: rgb(87, 188, 250);font-size: 30px;"></i>&nbsp;&nbsp;<?php echo $list['title'] ?><span class="seeall"><i class="fa fa-chevron-circle-right" style="font-size: 14px;padding: 0 4px;"></i><a class="all" href="/discover/view/<?php echo $type; ?>"><?php echo Text::get('regular-see_all'); ?></a></span></h2>
            <?php foreach ($list as $group=>$projects) : ?>
                <div
							id="discover-group-<?php echo $type ?>-<?php echo $group ?>">

                    <?php
						
						foreach ( $projects ['items'] as $project ) :
							echo new View ( 'view/project/widget/project.html.php', array (
									'project' => $project 
							) );
						endforeach
						;
						?>

						</div>
            <?php endforeach; ?>
	
						</div>

    <?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="homeMap" class="discover-map">
<div id="mapDiv"></div>
<script type="text/javascript" src="http://finpop.dev/view/js/mmc-map-v2.js"></script>
<script type="text/javascript">
	require(['mfMapv2'], function (mfMapv2) {
        var options = {
            mapCenter: new google.maps.LatLng(46.52863469527167,2.43896484375),
            params: {
                tag: 'all',
                status: 'gauged'
            },
            showButton: false,
            controlOverlay: false,
            buttonId: '#localization',
            urlInfoBox: '',
            mapDivId: 'mapDiv',
            scrollwheel: false,
            markerImage: '/img/mmc/maps/map-cluster-01.png',
            panControlOptions: {
                position: google.maps.ControlPosition.TOP_RIGHT
            },
            zoomControlOptions: {
                position: google.maps.ControlPosition.TOP_RIGHT
            },
            mapStyles: [{
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#44aaee"
                }]
            }, {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#06568b"
                }]
            }, {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [{
                    "visibility": "off"
                }, {
                    "lightness": -20
                }]
            }, {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#284a62"
                }, {
                    "lightness": -17
                }]
            }, {
                "elementType": "labels.text.stroke",
                "stylers": [{
                    "color": "#ffffff"
                }, {
                    "visibility": "off"
                }, {
                    "weight": 0.9
                }]
            }, {
                "elementType": "labels.text.fill",
                "stylers": [{
                    "visibility": "off"
                }, {
                    "color": "#ffffff"
                }]
            }, {
                "featureType": "poi",
                "elementType": "labels",
                "stylers": [{
                    "visibility": "simplified"
                }]
            }, {
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#284a62"
                }, {
                    "lightness": -10
                }]
            }, {}, {
                "featureType": "administrative",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#44aaee"
                }, {
                    "weight": 0.7
                }]
            }, {
                featureType: 'administrative.country',
                elementType: 'labels',
                stylers: [{
                    hue: '#777777'
                }, {
                    saturation: 0
                }, {
                    lightness: -8
                }, {
                    visibility: 'off'
                }]
            },{
        		featureType: 'administrative.locality',
        		elementType: 'all',
        		stylers: [
        			{ hue: '#777777' },
        			{ saturation: 0 },
        			{ lightness: 47 },
        			{ visibility: 'off' }
        		]
            }
        ],
        clusterStyles: [
                {
                    url: '/img/mmc/maps/map-cluster-a.png',
                    height: 47,
                    width: 44,
                    anchor: [8, 12],
                    textColor: '#5aaa4b',
                    textSize: 11
                },{
                    url: '/img/mmc/maps/map-cluster-b.png',
                    height: 47,
                    width: 43,
                    anchor: [8, 13],
                    textColor: '#5aaa4b',
                    textSize: 11
                },{
                    url: '/img/mmc/maps/map-cluster-c.png',
                    height: 47,
                    width: 41,
                    anchor: [7, 10],
                    textColor: '#348724',
                    textSize: 11
                },{
                    url: '/img/mmc/maps/map-cluster-d.png',
                    height: 43,
                    width: 39,
                    anchor: [5, 10],
                    textColor: '#348724',
                    textSize: 11
                }
            ]
        };
        $('#mapDiv').mfMapv2(options);
	});
</script>
	</div>

<?php include 'view/footer.html.php'?>

<?php include 'view/epilogue.html.php' ?>