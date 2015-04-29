<?php 
use Goteo\Core\View;
?>
<div class="container" id="projects-phares">
<div class="row clearfix">
<h2 class="odin" style="margin: 60px 0 -7px 18px; text-align:center;font-weight:bold;">Projets R&eacute;cents</h2><hr style="height: 3px; width: 88px; color: #0387f3; background-color: #0387f3;"></hr>
		
		
		<ul id="filters" class="clearfix">
    <li><span class="filter active" data-filter="app card icon logo web">Tout</span></li>
    <li><span class="filter" data-filter="card">R&#233;cents</span></li>
    <li><span class="filter" data-filter="icon">&#192; l'affiche</span></li>
 </ul>
		
		
		
		
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