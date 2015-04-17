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
use Goteo\Core\View, Goteo\Model\Image, Goteo\Library\Text;

// @NODESYS
// @CALLSYS
$bodyClass = 'home';
// para que el prologue ponga el código js para botón facebook en el bannerside
$fbCode = Text::widget ( Text::get ( 'social-account-facebook' ), 'fb' );

// metas og: para que al compartir en facebook coja las imagenes de novedades
$ogmeta = array (
		'title' => 'Goteo.org',
		'description' => 'Goteo.org',
		'url' => SITE_URL 
);
if (! empty ( $this ['posts'] )) {
	foreach ( $this ['posts'] as $post ) {
		if (count ( $post->gallery ) > 1) {
			foreach ( $post->gallery as $pbimg ) {
				if ($pbimg instanceof Image) {
					$ogmeta ['image'] [] = $pbimg->getLink ( 500, 285 );
				}
			}
		} elseif (! empty ( $post->image )) {
			$ogmeta ['image'] [] = $post->image->getLink ( 500, 285 );
		}
	}
}

include 'view/prologue.html.php';
include 'view/header.html.php';
?>
<?php if(isset($_SESSION['messages'])) { include 'view/header/message.html.php'; } ?>
<link rel="stylesheet" type="text/css"
	href="<?php echo SRC_URL ?>/view/css/SlitSlider/demo.css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo SRC_URL ?>/view/css/SlitSlider/style.css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo SRC_URL ?>/view/css/SlitSlider/custom.css" />
<script type="text/javascript"
	src="<?php echo SRC_URL ?>/view/js/SlitSlider/modernizr.custom.79639.js"></script>
<noscript>
	<link rel="stylesheet" type="text/css"
		href="<?php echo SRC_URL ?>/view/css/styleNoJS.css" />
</noscript>
<div class="container-slider demo-2">

	<div id="slider" class="sl-slider-wrapper">

		<div class="sl-slider">

			<div class="sl-slide" data-orientation="horizontal"
				data-slice1-rotation="-25" data-slice2-rotation="-25"
				data-slice1-scale="2" data-slice2-scale="2">
				<div class="sl-slide-inner">
					<div class="bg-img"
						style="background-image: url('view/css/images/1.jpg');"></div>
					<h2>A bene placito.</h2>
					<blockquote>
						<p>You have just dined, and however scrupulously the
							slaughterhouse is concealed in the graceful distance of miles,
							there is complicity.</p>
						<cite>Ralph Waldo Emerson</cite>
					</blockquote>
					<p class="button">
						<a href="#" class="first">Savoir Plus</a> <a href="#"
							class="second">Lien 2</a>
					</p>
				</div>
			</div>

			<div class="sl-slide" data-orientation="vertical"
				data-slice1-rotation="10" data-slice2-rotation="-15"
				data-slice1-scale="1.5" data-slice2-scale="1.5">
				<div class="sl-slide-inner">
					<div class="bg-img bg-img-2"></div>
					<h2>Regula aurea.</h2>
					<blockquote>
						<p>Until he extends the circle of his compassion to all living
							things, man will not himself find peace.</p>
						<cite>Albert Schweitzer</cite>
					</blockquote>
					<p class="button">
						<a href="#" class="first">Savoir Plus</a> <a href="#"
							class="second">Lien 2</a>
					</p>
				</div>
			</div>

			<div class="sl-slide" data-orientation="horizontal"
				data-slice1-rotation="3" data-slice2-rotation="3"
				data-slice1-scale="2" data-slice2-scale="1">
				<div class="sl-slide-inner">
					<div class="bg-img bg-img-3"></div>
					<h2>Dum spiro, spero.</h2>
					<blockquote>
						<p>Thousands of people who say they 'love' animals sit down once
							or twice a day to enjoy the flesh of creatures who have been
							utterly deprived of everything that could make their lives worth
							living and who endured the awful suffering and the terror of the
							abattoirs.</p>
						<cite>Dame Jane Morris Goodall</cite>
					</blockquote>
					<p class="button">
						<a href="#" class="first">Savoir Plus</a> <a href="#"
							class="second">Lien 2</a>
					</p>
				</div>
			</div>

			<div class="sl-slide" data-orientation="vertical"
				data-slice1-rotation="-5" data-slice2-rotation="25"
				data-slice1-scale="2" data-slice2-scale="1">
				<div class="sl-slide-inner">
					<div class="bg-img bg-img-4"></div>
					<h2>Donna nobis pacem.</h2>
					<blockquote>
						<p>The human body has no more need for cows' milk than it does for
							dogs' milk, horses' milk, or giraffes' milk.</p>
						<cite>Michael Klaper M.D.</cite>
					</blockquote>
					<p class="button">
						<a href="#" class="first">Savoir Plus</a> <a href="#"
							class="second">Lien 2</a>
					</p>
				</div>
			</div>

			<div class="sl-slide" data-orientation="horizontal"
				data-slice1-rotation="-5" data-slice2-rotation="10"
				data-slice1-scale="2" data-slice2-scale="1">
				<div class="sl-slide-inner">
					<div class="bg-img bg-img-5"></div>
					<h2>Acta Non Verba.</h2>
					<blockquote>
						<p>I think if you want to eat more meat you should kill it
							yourself and eat it raw so that you are not blinded by the
							hypocrisy of having it processed for you.</p>
						<cite>Margi Clarke</cite>
					</blockquote>
					<p class="button">
						<a href="#" class="first">Savoir Plus</a> <a href="#"
							class="second">Lien 2</a>
					</p>
				</div>
			</div>
		</div>
		<!-- /sl-slider -->

		<nav id="nav-dots" class="nav-dots">
			<span class="nav-dot-current"></span> <span></span> <span></span> <span></span>
			<span></span>
		</nav>
		<!-- arrow navigation -->
		<div class="arrow-button">
			<a href="#" id="nav-next-button"><i class="fa  fa-arrow-right fa-4x"
				style="color: #FFF"></i></a> <a href="#" id="nav-prev-button"><i
				class="fa  fa-arrow-left fa-4x" style="color: #FFF"></i></a>
		</div>
	</div>
</div>
<!-- /slider-wrapper -->
<script type="text/javascript"
	src="<?php echo SRC_URL ?>/view/js/SlitSlider/jquery.ba-cond.min.js"></script>
<script type="text/javascript"
	src="<?php echo SRC_URL ?>/view/js/SlitSlider/jquery.slitslider.js"></script>
<script type="text/javascript">	
			$(function() {
			
				var Page = (function() {

					var $nav = $( '#nav-dots > span' ),
						slitslider = $( '#slider' ).slitslider( {
							onBeforeChange : function( slide, pos ) {

								$nav.removeClass( 'nav-dot-current' );
								$nav.eq( pos ).addClass( 'nav-dot-current' );

							}
						} ),

						init = function() {

							initEvents();
							
						},
						initEvents = function() {

							$nav.each( function( i ) {
							
								$( this ).on( 'click', function( event ) {
									
									var $dot = $( this );
									
									if( !slitslider.isActive() ) {

										$nav.removeClass( 'nav-dot-current' );
										$dot.addClass( 'nav-dot-current' );
									
									}
									
									slitslider.jump( i + 1 );
									return false;
								
								} );
								
							} );

							 $( '#nav-next-button' ).on('click',function(event){
								 var pos = 0;
								 $nav.each( function( i ) {
									if($nav[i].className=="nav-dot-current"){
										pos=i;
									}
								 });									
								 slitslider.jump( pos+2 );
								return false;
							 });
							 $( '#nav-prev-button' ).on('click',function(event){
								 var pos = 0;
								 $nav.each( function( i ) {
									if($nav[i].className=="nav-dot-current"){
										pos=i;
									}
								 });							
								slitslider.jump( pos );
								return false;
							 });
						};

						return { init : init };

				})();

				Page.init();

				/**
				 * Notes: 
				 * 
				 * example how to add items:
				 */

				/*
				
				var $items  = $('<div class="sl-slide sl-slide-color-2" data-orientation="horizontal" data-slice1-rotation="-5" data-slice2-rotation="10" data-slice1-scale="2" data-slice2-scale="1"><div class="sl-slide-inner bg-1"><div class="sl-deco" data-icon="t"></div><h2>some text</h2><blockquote><p>bla bla</p><cite>Margi Clarke</cite></blockquote></div></div>');
				
				// call the plugin's add method
				ss.add($items);

				*/
			
			});
		</script>

 <div class="features">
	<div class="container">
		<div class="row clearfix">
			<div class="col-md-4 column text-center">
				<i class="fa fa-user fa-3x" aria-hidden="true"></i>
				<h4 class="service">Feature 1</h4>
			</div>
			<div class="col-md-4 column text-center">
				<i class="fa fa-trophy fa-3x" aria-hidden="true"></i>
				<h4 class="service">Feature 2</h4>
			</div>
			<div class="col-md-4 column text-center">
				<i class="fa fa-video-camera fa-3x" aria-hidden="true"></i>
				<h4 class="service">Feature 3<?php echo $this['count']?></h4>
			</div>
		</div>
	</div>
</div>

<div class="panel-scroll">
 <?php
				foreach ( $this ['order'] as $item => $itemData ) {
					if (! empty ( $this [$item] ))
						echo new View ( "view/home/{$item}.html.php", $this );
				}
				?>
<?php include 'view/home/presskit.html.php'; ?>
<?php include 'view/footer.html.php'; ?>
</div>
<?php include 'view/epilogue.html.php'; ?>