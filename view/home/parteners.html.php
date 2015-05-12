<?php 
use Goteo\Library\Text;

$parteners = $this ['parteners'];

?>
<link rel="stylesheet" type="text/css" href="view/css/owlcarrousel/css/style.css" />
<link rel="stylesheet" type="text/css"	href="view/css/owlcarrousel/css/owl.carousel.css" />
<link rel="stylesheet" type="text/css"	href="view/css/owlcarrousel/css/owl.theme.css" />
<script type="text/javascript" src="view/css/owlcarrousel/js/owl.carousel.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	 
	  $("#owl-demo").owlCarousel({
		  
	      autoPlay: 3000, //Set AutoPlay to 3 seconds
	      loop:true,
	      responsiveClass:true,
	      responsive:{
	          0:{
	              items:1,
	              nav:true
	          },
	          600:{
	              items:3,
	              nav:false
	          },
	          1000:{
	              items:5,
	              nav:true,
	              loop:false
	          }
	      }
	 		
	  });
	 
	});
</script>
<div class="photostack">
<div class="row clearfix">
<h2 style=" font-family:Open Sans Semibold; color:white;text-align:center;">Nos Partenaires</h2><hr style="height: 3px; width: 88px; color: white; background-color: white;"></hr>
<div class="texte">Finpop favorise ses relations avec ses partenaires ! Nous collaborons dans nos projets dans le but de r&eacute;pondre au plus vite et de la mani&egrave;re la plus adapt&eacute;e &agrave; tous vos besoins !</div>
<div id="owl-demo">
    
 <?php foreach ($parteners as $part) : ?> 
<div style=" background-image:url('view/css/owlcarrousel/img/cercle.png');" class="pastille"> 

<div class="itemimg" style="background-image:url('<?php echo SRC_URL."/image/".$part->image."/100/100"; ?>');background-color: white;background-repeat: no-repeat; background-position: center center;">


</div>

  </div>
  <?php endforeach;?>
</div>
</div></div>
