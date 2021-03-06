<?php
/*
 *  Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
 *	This file is part of Goteo.
 *
 *  Goteo is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Goteo is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with Goteo.  If not, see <http://www.gnu.org/licenses/agpl.txt>.
 *
 */

use Goteo\Core\View,
    Goteo\Library\Text;

$bodyClass = 'discover';

include 'view/prologue.html.php';

include 'view/header.html.php' ?>

<link href="/view/css/custom.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
$(document).ready(function(){
    // Condition d'affichage du bouton
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100){
            $('.go_top').fadeIn();
        }
        else{
            $('.go_top').fadeOut();
        }
    });
    // Evenement au clic
    $('.go_top').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });
});

</script>


<div class="jumbotron" id="resultat_projet">

	<div class="container">
		<div class="content-center2">
			<span id="tit-slid-resultat"> Resultats de recherche</span> <span
				id="type"><?php echo $_GET['type'];?> </span>


			<div id="retour-boutton">
				<a class="" href="/discover">
					<button type="submit" class="btn btn-primary retour-btn"
						name="retour">
						<i class="fa fa-chevron-left"></i>&nbsp;retour 
					</button>
				</a>
			</div>




		</div>
	</div>

</div>




     <!--     <div id="sub-header">
            <div>
                <h2 class="title"><?php echo Text::get('discover-results-header'); ?></h2>
            </div>

        </div>-->
        
        
<div class="container" id="projects-area">
	<div class="row clearfix">
	<div class="row clearfix">
	<div class="col-md-3 column">
			
			 <?php echo new View('view/discover/searcher.html.php',
                                array('params'     => $this['params'])); ?>
				</div>
	
	
	
	
	
	
	
			
				
				<div class="col-md-9 column box-border-left">
				<a href="#" class="go_top">Remonter</a>
				
				
				<div class="widget projects">
				<h2 class="title-voirproj">Projets trouv&eacute;s

					</h2>
					
					<hr id="ligne-voirproj">
					
					
                <?php if (!empty($this['results'])) :
                    foreach ($this['results'] as $result) :
                        echo new View('view/project/widget/project.html.php', array(
                            'project' => $result
                        )); 
                    endforeach;
                else :
                    echo Text::get('discover-results-empty');
                endif; ?>
            </div>
				</div>
			</div>
		</div>
	</div>

  

        <?php include 'view/footer.html.php' ?>
    
<?php include 'view/epilogue.html.php' ?>