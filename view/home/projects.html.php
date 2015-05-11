<?php 
use Goteo\Core\View;
?>
<script type="text/javascript"
	src="<?php echo SRC_URL ?>/view/js/jquery.easing.min.js"></script>
<script type="text/javascript"
	src="<?php echo SRC_URL ?>/view/js/jquery.mixitup.min.js"></script>
<link type="text/css" href="<?php echo SRC_URL ?>/view/css/custom-project.css" rel="stylesheet" media="all" />
<link type="text/css" href="<?php echo SRC_URL ?>/view/css/normalize.css" rel="stylesheet" media="all" />
<script type="text/javascript">	

	$(function () {
	    
	    var filterList = {
	    
	        init: function () {
	        
	            // MixItUp plugin
	            // http://mixitup.io
	            $('#portfoliolist').mixitup({
	                targetSelector: '.portfolio',
	                filterSelector: '.filter',
	                effects: ['fade'],
	                easing: 'snap',
	                // call the hover effect
	              //  onMixEnd: filterList.hoverEffect()
	            });                
	        
	        },
	        
	        hoverEffect: function () {
	        
	            // Simple parallax effect
	            $('#portfoliolist .portfolio').hover(
	                function () {
	                    $(this).find('.label').stop().animate({bottom: 0}, 200, 'easeOutQuad');
	                    $(this).find('img').stop().animate({top: -30}, 500, 'easeOutQuad');                
	                },
	                function () {
	                    $(this).find('.label').stop().animate({bottom: -40}, 200, 'easeInQuad');
	                    $(this).find('img').stop().animate({top: 0}, 300, 'easeOutQuad');                                
	                }        
	            );                
	        
	        }
	    };
	    
	    // Run the show!
	    filterList.init();
	    
	});   

	</script>
	
<div class="container" id="projects-phares">
<div class="row clearfix">
<h2 style=" font-family:Open Sans Semibold;text-align:center;">Projets R&eacute;cents</h2><hr style="height: 3px; width: 88px; color: #0387f3; background-color: #0387f3;"></hr>
		
	<ul id="filters" class="clearfix">
    <li><span class="filter active" data-filter="recent showing">Tout</span></li>
    <li><span class="filter" data-filter="recent">R&#233;cents</span></li>
    <li><span class="filter" data-filter="showing">&#192; l'affiche</span></li>
 </ul>
 
 <div id="portfoliolist">        
    <div class="portfolio recent" data-cat="recent">
        <div class="portfolio-wrapper"> 
 <?php
		foreach ( $this ['projects'] as $project ) :
		echo '<div class="col-md-4 column animated fadeInUp">' . new View ( 'view/project/widget/project.html.php', array (
		'project' => $project
		) ) . "</div>";
		endforeach
		;
		?>   
 
		 
		            
            </div>
        </div>
    </div> 
    

		
		
	</div>
	</div>
	