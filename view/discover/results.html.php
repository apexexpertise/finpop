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

        <div id="sub-header">
            <div>
                <h2 class="title"><?php echo Text::get('discover-results-header'); ?></h2>
            </div>

        </div>
<div class="container" id="projects-area">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<div class="row clearfix">
				<div class="col-md-2 column">
				            <?php echo new View('view/discover/searcher.html.php',
                                array('params'     => $this['params'])); ?>
				</div>
				<div class="col-md-10 column box-border-left">
				<h2 class="header-title"><i class="fa fa-cogs fa-1x" style="color: rgb(87, 188, 250);font-size: 30px;"></i>&nbsp;&nbsp;Projets trouv&eacute;s</h2>
				<div class="widget projects">
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
</div>
  

        <?php include 'view/footer.html.php' ?>
    
<?php include 'view/epilogue.html.php' ?>