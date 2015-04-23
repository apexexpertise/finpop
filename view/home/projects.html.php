<?php use Goteo\Core\View;?>
<div class="container" id="projects-phares">
<div class="row clearfix">
<h2 class="odin"
		style="margin: 50px 0 -7px 18px; border-bottom: 1px solid rgba(203, 203, 203, 0.44);">Projets
		R&eacute;cents</h2>
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