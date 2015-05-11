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
use Goteo\Library\Text;

$banners= $this ['banners'];
?>
<link rel="stylesheet" type="text/css"
	href="<?php echo SRC_URL ?>/view/css/Slidesjs/style.css" />
	
<div id="slides">

	<?php foreach ($banners as $banner) : ?>
<div class="sl-slide">
      <img class="image" src="<?php echo SRC_URL."/image/".$banner->image."/940/528"; ?>" alt="" />
      
      <h2><?php echo $banner->title?></h2>
      <hr ></hr>
       <p><?php echo $banner->description?></p>
       
       <p class="button">
	   <a href="#" class="first"><?php echo $banner->url?></a> 
					
	   </p>
 <!-- arrow navigation -->
<div class="arrow-button">
<a href="#" class="nav-next-button"><img src="view/css/images/nav-next-button.png" onmouseover="this.src='view/css/images/large_right.png'" onmouseout="this.src='view/css/images/nav-next-button.png'"></a>
<a href="#" class="nav-prev-button"><img src="view/css/images/nav-prev-button.png" onmouseover="this.src='view/css/images/large_left.png'" onmouseout="this.src='view/css/images/nav-prev-button.png'"></a>
</div>
</div>
    <?php endforeach; ?>

	
</div>
   
    


<!-- /slider-wrapper -->

<script type="text/javascript"
	src="<?php echo SRC_URL ?>/view/js/Slidesjs/jquery.slides.min.js"></script>
<script type="text/javascript">	
$(function(){
    $("#slides").slidesjs({
      width: 940,
      height: 528,
      callback: {
          loaded: function(){
            // hide navigation and pagination
            $('.slidesjs-pagination, .slidesjs-navigation').hide(0); 
          }
      }
    });

    // custom navigation/pagination links for slideshow

   

	 $('.nav-next-button').click(function(e) {
		  e.preventDefault();
		  // emulate next click
		  $('.slidesjs-next').click();
		});
		$('.nav-prev-button').click(function(e) {
		  e.preventDefault();
		  // emulate previous click
		  $('.slidesjs-previous').click();
		});
    
   
  });
</script>
<div class="features-blur-box"></div>
<div class="features">
	<div class="container">
		<div class="row clearfix">
			<div class="col-md-4 column text-center">
			<img src="view/css/images/feature1.png">
				<h4 class="service">Fun peoples</h4>
				<h4 class="service-number">425 000</h4>
			</div>
			<div class="col-md-4 column text-center">
				<img src="view/css/images/feature2.png">
				<h4 class="service">Fonds lev&#233;s</h4>
				<h4 class="service-number">690 900 &#128;</h4>
			</div>
			<div class="col-md-4 column text-center">
				<img src="view/css/images/feature3.png">
				<h4 class="service">A votre disposition au </h4>
				<h4 class="service-number">5 31 61 62 63</h4>
			</div>
		</div>
	</div>
</div>


